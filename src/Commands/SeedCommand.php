<?php

declare(strict_types=1);

/**
 * SeedCommand.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Commands;

use Blackcube\Dboard\Services\ImportService;
use Blackcube\Dcore\Models\Content;
use Blackcube\Dcore\Models\Language;
use Blackcube\Dcore\Models\Menu;
use Blackcube\Dcore\Models\Type;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Yii\Console\ExitCode;

/**
 * Seeds the demo content tree from data/seed/*.json.
 *
 * The site is a Hazeltree: a redirect-lang Dispatch is the root; the landing homes
 * (en, fr) hang under it, and each home holds its sibling pages (about, faq) plus
 * contact. Slugs are decoupled from the tree (e.g. the FAQ lives under the home but
 * its slug is "faq", not "en/about/faq"). The error pages live in a separate,
 * non-routable "Support" sub-tree (Support → language → not-found/server-error),
 * resolved by Type handler + language, never by URL. Routable contents are imported
 * parents first via the ImportService (carrying their own slug); the error sub-tree
 * is built directly since those nodes have no slug.
 *
 * Idempotent: the content/type tables are truncated first, so a run always yields
 * the same ids (the Dispatch is id 1, which the Sidebar widget relies on).
 * Everything initialised by the dcore/dboard migrations (host, languages, RBAC)
 * and the dboard onboarding (admin) is left untouched.
 */
#[AsCommand(
    name: 'app:seed',
    description: 'Seed the demo content tree (multi-language, idempotent).',
)]
class SeedCommand extends Command
{
    /**
     * Tables truncated before seeding (content + type domain only).
     *
     * @var list<string>
     */
    private const TRUNCATE = [
        'contents_blocs', 'contents_authors', 'contents_tags', 'xeos_blocs',
        'xeos', 'sitemaps', 'blocs', 'slugs', 'contents', 'contentTranslationGroups', 'menus', 'types',
    ];

    /**
     * Demo content tree. Order matters: a parent must come before its children.
     * "name" is the content type label; "file" carries its own slug.
     *
     * @var list<array{key: string, name: string, handler: string, file: string, parent: ?string}>
     */
    private const SEEDS = [
        ['key' => 'dispatch', 'name' => 'Redirect', 'handler' => 'redirect-lang', 'file' => 'dispatch.json', 'parent' => null],
        ['key' => 'en', 'name' => 'Landing', 'handler' => 'landing', 'file' => 'home-en.json', 'parent' => 'dispatch'],
        ['key' => 'en-about', 'name' => 'Page', 'handler' => 'page', 'file' => 'about-en.json', 'parent' => 'en'],
        ['key' => 'en-faq', 'name' => 'Page', 'handler' => 'page', 'file' => 'faq-en.json', 'parent' => 'en'],
        ['key' => 'en-contact', 'name' => 'Contact', 'handler' => 'contact', 'file' => 'contact-en.json', 'parent' => 'en'],
        ['key' => 'fr', 'name' => 'Landing', 'handler' => 'landing', 'file' => 'home-fr.json', 'parent' => 'dispatch'],
        ['key' => 'fr-apropos', 'name' => 'Page', 'handler' => 'page', 'file' => 'apropos-fr.json', 'parent' => 'fr'],
        ['key' => 'fr-faq', 'name' => 'Page', 'handler' => 'page', 'file' => 'faq-fr.json', 'parent' => 'fr'],
        ['key' => 'fr-contact', 'name' => 'Contact', 'handler' => 'contact', 'file' => 'contact-fr.json', 'parent' => 'fr'],
    ];

    /**
     * Error pages, grouped under a non-routable "Support" root (no slug), then a
     * non-routable node per language. The error contents themselves carry no slug:
     * the SSR layer resolves them by Type handler + language (HandlerDescriptor::findByError),
     * never by URL — so the tree placement is fully decoupled from routing.
     *
     * @var list<array{name: string, handler: string}>
     */
    private const ERROR_PAGES = [
        ['name' => 'Not Found', 'handler' => 'not-found'],
        ['name' => 'Server Error', 'handler' => 'server-error'],
    ];

    /** Languages for which an error sub-tree is created. */
    private const ERROR_LANGS = ['en', 'fr'];

    /**
     * Language pairs linked as translations of each other (powers the language switch).
     *
     * @var list<array{0: string, 1: string}>
     */
    private const TRANSLATIONS = [
        ['en', 'fr'],
        ['en-about', 'fr-apropos'],
        ['en-faq', 'fr-faq'],
        ['en-contact', 'fr-contact'],
    ];

    /**
     * Navigation menus, one root per (name, language) with content links.
     * Header and Footer both list the three sections (About, FAQ, Contact).
     *
     * @var list<array{name: string, lang: string, items: list<array{name: string, key: string}>}>
     */
    private const MENUS = [
        ['name' => 'Header', 'lang' => 'en', 'items' => [['name' => 'About', 'key' => 'en-about'], ['name' => 'FAQ', 'key' => 'en-faq'], ['name' => 'Contact', 'key' => 'en-contact']]],
        ['name' => 'Header', 'lang' => 'fr', 'items' => [['name' => 'À propos', 'key' => 'fr-apropos'], ['name' => 'FAQ', 'key' => 'fr-faq'], ['name' => 'Contact', 'key' => 'fr-contact']]],
        ['name' => 'Footer', 'lang' => 'en', 'items' => [['name' => 'About', 'key' => 'en-about'], ['name' => 'FAQ', 'key' => 'en-faq'], ['name' => 'Contact', 'key' => 'en-contact']]],
        ['name' => 'Footer', 'lang' => 'fr', 'items' => [['name' => 'À propos', 'key' => 'fr-apropos'], ['name' => 'FAQ', 'key' => 'fr-faq'], ['name' => 'Contact', 'key' => 'fr-contact']]],
    ];

    public function __construct(
        private readonly ImportService $importService,
        private readonly ConnectionInterface $db,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Seeding demo content tree');

        $this->cleanup();
        $this->activateLanguages($io);

        $seedDir = dirname(__DIR__, 2).'/data/seed';
        $pathByKey = [];
        $contentByKey = [];

        foreach (self::SEEDS as $spec) {
            $file = $seedDir.'/'.$spec['file'];
            if (is_file($file) === false) {
                $io->writeln(sprintf('  <comment>=</comment> %s skipped (no %s)', $spec['key'], $spec['file']));
            } else {
                $parsed = $this->importService->parseJson((string) file_get_contents($file));
                if ($parsed['valid'] === false) {
                    $io->writeln(sprintf('  <error>x</error> %s: %s', $spec['key'], $parsed['error']));
                } else {
                    $data = $parsed['data'];
                    $data['typeId'] = $this->ensureType($spec['name'], $spec['handler']);
                    $data['path'] = null;
                    $data = $this->resolveImages($data);

                    $parentPath = $spec['parent'] !== null ? ($pathByKey[$spec['parent']] ?? null) : null;
                    $content = $this->runImport($data, $parentPath, $io, $spec['key']);
                    if ($content !== null) {
                        $pathByKey[$spec['key']] = $content->getPath();
                        $contentByKey[$spec['key']] = $content;
                        $io->writeln(sprintf('  <info>+</info> %s (id=%d, path=%s)', $spec['key'], $content->getId(), $content->getPath()));
                    }
                }
            }
        }

        $this->linkTranslations($contentByKey, $io);
        $this->seedMenus($contentByKey, $io);
        $this->seedErrorTree($io);

        $io->success('Demo content tree seeded.');

        return ExitCode::OK;
    }

    /**
     * Truncates the content/type tables (FK checks off), resetting ids.
     */
    private function cleanup(): void
    {
        $this->db->createCommand('SET FOREIGN_KEY_CHECKS = 0')->execute();
        foreach (self::TRUNCATE as $table) {
            $this->db->createCommand()->truncateTable($table)->execute();
        }
        $this->db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
    }

    /**
     * Activates the demo languages so the multi-language tree and the back-office
     * language selector resolve them (migrations leave only the main one active).
     */
    private function activateLanguages(SymfonyStyle $io): void
    {
        foreach (['fr', 'en'] as $langId) {
            $language = Language::query()->andWhere(['id' => $langId])->one();
            if ($language !== null && $language->isActive() === false) {
                $language->setActive(true);
                $language->save();
                $io->writeln(sprintf('  <info>+</info> language %s activated', $langId));
            }
        }
    }

    /**
     * Returns the id of the content type for $handler, creating it when missing.
     */
    private function ensureType(string $name, string $handler): int
    {
        $type = Type::query()->andWhere(['handler' => $handler])->one();
        if ($type === null) {
            $type = new Type();
            $type->setName($name);
            $type->setHandler($handler);
            $type->setContentAllowed(true);
            $type->setTagAllowed(true);
            $type->save();
        }

        return (int) $type->getId();
    }

    /**
     * Imports one content under $parentPath (null = root), then activates it.
     * Returns the created content, or null when import fails.
     *
     * @param array<string, mixed> $data
     */
    private function runImport(array $data, ?string $parentPath, SymfonyStyle $io, string $label): ?Content
    {
        $content = null;
        $references = $this->importService->validateReferences($data);

        if (empty($references['missing']) === false) {
            $io->writeln(sprintf('  <error>x</error> %s — missing references: %s', $label, json_encode($references['missing'])));
        } else {
            $result = $this->importService->execute($data, 'create', $parentPath, []);
            if ($result['success'] === false) {
                $io->writeln(sprintf('  <error>x</error> %s: %s', $label, $result['error']));
            } else {
                $content = $result['model'];
                $content->setActive(true);
                $content->save();
            }
        }

        return $content;
    }

    /**
     * Links the language pairs as translations of each other.
     *
     * @param array<string, Content> $contentByKey
     */
    private function linkTranslations(array $contentByKey, SymfonyStyle $io): void
    {
        foreach (self::TRANSLATIONS as [$a, $b]) {
            if (isset($contentByKey[$a], $contentByKey[$b]) === true) {
                $contentByKey[$a]->linkTranslation($contentByKey[$b]);
                $io->writeln(sprintf('  <info>~</info> %s <-> %s linked', $a, $b));
            }
        }
    }

    /**
     * Creates the navigation menus (one root per name/language: Header, Footer).
     *
     * @param array<string, Content> $contentByKey
     */
    private function seedMenus(array $contentByKey, SymfonyStyle $io): void
    {
        foreach (self::MENUS as $menu) {
            $root = new Menu();
            $root->setName($menu['name']);
            $root->setLanguageId($menu['lang']);
            $root->setHostId(1);
            $root->setActive(true);
            $root->save();

            foreach ($menu['items'] as $item) {
                if (isset($contentByKey[$item['key']]) === true) {
                    $node = new Menu();
                    $node->setName($item['name']);
                    $node->setLanguageId($menu['lang']);
                    $node->setHostId(1);
                    $node->setRoute('dcore-c-'.$contentByKey[$item['key']]->getId());
                    $node->setActive(true);
                    $node->saveInto($root);
                }
            }

            $io->writeln(sprintf('  <info>+</info> menu %s (%s)', $menu['name'], $menu['lang']));
        }
    }

    /**
     * Builds the error sub-tree: a non-routable "Support" root, a non-routable node
     * per language, and the error pages under each. Created directly (not via the
     * ImportService, which always mints a slug) so they stay slug-less; the SSR layer
     * resolves them by Type handler + language, not by URL.
     */
    private function seedErrorTree(SymfonyStyle $io): void
    {
        $support = $this->makeContainer('Support', self::ERROR_LANGS[0], null);
        $io->writeln(sprintf('  <info>+</info> Support (id=%d, non-routable)', $support->getId()));

        foreach (self::ERROR_LANGS as $lang) {
            $langNode = $this->makeContainer($lang, $lang, $support);
            foreach (self::ERROR_PAGES as $page) {
                $typeId = $this->ensureType($page['name'], $page['handler']);
                $this->makeErrorPage($page['name'], $typeId, $lang, $langNode);
            }
            $io->writeln(sprintf('  <info>+</info> Support/%s + not-found + server-error', $lang));
        }
    }

    /**
     * Creates a non-routable tree node (no slug, no type): a pure container.
     * Saved as a root when $parent is null, otherwise grafted under $parent.
     */
    private function makeContainer(string $name, string $languageId, ?Content $parent): Content
    {
        $content = new Content();
        $content->setName($name);
        $content->setLanguageId($languageId);
        $content->setTypeId(null);
        $content->setSlugId(null);
        $content->setElasticSchemaId(null);
        $content->setActive(true);
        if ($parent === null) {
            $content->save();
        } else {
            $content->saveInto($parent);
        }

        return $content;
    }

    /**
     * Creates a slug-less error page (typed not-found/server-error) under $parent.
     */
    private function makeErrorPage(string $name, int $typeId, string $languageId, Content $parent): void
    {
        $content = new Content();
        $content->setName($name);
        $content->setLanguageId($languageId);
        $content->setTypeId($typeId);
        $content->setSlugId(null);
        $content->setElasticSchemaId(null);
        $content->setActive(true);
        $content->saveInto($parent);
    }

    /**
     * Replaces image references whose data is an http(s) URL (e.g. Unsplash) with an
     * embedded base64 data URI. Already-embedded data URIs are left as is.
     *
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    private function resolveImages(array $data): array
    {
        array_walk_recursive($data, function (mixed &$value, int|string $key): void {
            if ($key === 'data' && is_string($value) === true && preg_match('#^https?://#', $value) === 1) {
                $binary = @file_get_contents($value);
                if ($binary !== false) {
                    $value = 'data:'.$this->guessMime($value).';base64,'.base64_encode($binary);
                }
            }
        });

        return $data;
    }

    private function guessMime(string $url): string
    {
        $extension = strtolower((string) pathinfo((string) parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));

        return match ($extension) {
            'png' => 'image/png',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml',
            'webp' => 'image/webp',
            default => 'image/jpeg',
        };
    }
}
