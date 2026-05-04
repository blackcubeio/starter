<?php

declare(strict_types=1);

namespace App\Widgets;

use Blackcube\Dcore\Entities\Content;
use Blackcube\Dcore\Entities\Tag;
use App\Widgets\Header\Nav;
use RuntimeException;
use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Widget\Widget;

final class Header extends AbstractBaseWidget
{
    private Content|Tag|null $element = null;

    public function __construct(
        private readonly LocaleProvider $localeProvider,
    ) {
    }

    public function element(Content|Tag $element): self
    {
        $this->element = $element;
        return $this;
    }

    public function render(): string
    {
        $locale = $this->localeProvider->get()->asString();
        $homeUrl = '/';

        $root = Content::query()
            ->andWhere(['id' => 1])
            ->one();

        if ($root !== null) {
            $langRoot = $root->relativeQuery()
                ->children()
                ->andWhere(['languageId' => $locale])
                ->one();

            if ($langRoot !== null && $langRoot->getSlugId() !== null) {
                $slug = $langRoot->getSlugQuery()->one();
                if ($slug !== null) {
                    $link = $slug->getLink();
                    $homeUrl = $link->isTemplated()
                        ? '/' . ltrim($slug->getPath(), '/')
                        : $link->getHref();
                }
            }
        }

        $nav = Nav::widget()->render();

        $sidebarGroups = $this->buildSidebarGroups($locale);

        $translations = [];
        if ($this->element !== null) {
            foreach ($this->element->getTranslationsQuery()->each() as $translation) {
                if ($translation->getSlugId() === null) {
                    continue;
                }
                $tSlug = $translation->getSlugQuery()->one();
                if ($tSlug === null) {
                    continue;
                }
                $tLink = $tSlug->getLink();
                $tUrl = $tLink->isTemplated()
                    ? '/' . ltrim($tSlug->getPath(), '/')
                    : $tLink->getHref();
                $translations[] = [
                    'languageId' => $translation->getLanguageId(),
                    'url' => $tUrl,
                ];
            }
        }

        return $this->renderView('header', [
            'nav' => $nav,
            'homeUrl' => $homeUrl,
            'translations' => $translations,
            'sidebarGroups' => $sidebarGroups,
        ]);
    }

    private function buildSidebarGroups(string $locale): array
    {
        $root = Content::query()
            ->andWhere(['id' => 1])
            ->one();

        if ($root === null) {
            return [];
        }

        $langRoot = $root->relativeQuery()
            ->children()
            ->andWhere(['languageId' => $locale])
            ->one();

        if ($langRoot === null) {
            return [];
        }

        $langRootLevel = $langRoot->getLevel();
        $groups = [];
        $currentGroup = null;

        foreach ($langRoot->relativeQuery()
            ->children()
            ->includeDescendants()
            ->andWhere(['<=', 'level', $langRootLevel + 2])
            ->each() as $node) {
            if ($node->getLevel() === $langRootLevel + 1) {
                if ($currentGroup !== null) {
                    $groups[] = $currentGroup;
                }
                $url = null;
                if ($node->getSlugId() !== null) {
                    $slug = $node->getSlugQuery()->one();
                    if ($slug !== null) {
                        $link = $slug->getLink();
                        $url = $link->isTemplated()
                            ? '/' . ltrim($slug->getPath(), '/')
                            : $link->getHref();
                    }
                }
                $currentGroup = [
                    'name' => $node->getName(),
                    'url' => $url,
                    'items' => [],
                ];
            } elseif ($node->getLevel() === $langRootLevel + 2 && $currentGroup !== null) {
                if ($node->getSlugId() === null) {
                    continue;
                }
                $slug = $node->getSlugQuery()->one();
                if ($slug === null) {
                    continue;
                }
                $link = $slug->getLink();
                $url = $link->isTemplated()
                    ? '/' . ltrim($slug->getPath(), '/')
                    : $link->getHref();
                $currentGroup['items'][] = [
                    'name' => $node->getName(),
                    'url' => $url,
                ];
            }
        }
        if ($currentGroup !== null) {
            $groups[] = $currentGroup;
        }

        return $groups;
    }
}
