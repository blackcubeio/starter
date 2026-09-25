<?php
/**
 * header.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
/**
 * @var string $homeUrl
 * @var array{name: string, url: string}[] $navItems
 * @var array{languageId: string, url: string}[] $translations
 * @var \App\Widgets\Sidebar|null $sidebar
 */

use App\Widgets\Svg;
use Yiisoft\Html\Html;

$brandLogoSvg = Svg::logo('blackcube')->addClass('w-8 h-8 rounded-md overflow-hidden text-secondary-900 dark:text-white')->render();
$sunIconSvg = Svg::icon('sun')->addClass('w-5 h-5 hidden dark:block')->render();
$moonIconSvg = Svg::icon('moon')->addClass('w-5 h-5 block dark:hidden')->render();
$burgerIconSvg = Svg::icon('bars-3')->addClass('w-5 h-5')->render();
$closeIconSvg = Svg::icon('x-mark')->addClass('w-5 h-5')->render();

$brandHtml = $brandLogoSvg
    .Html::tag('span', 'Blackcube', ['class' => 'font-bold text-lg text-primary-900 dark:text-white tracking-tight']);

$themeToggleHtml = $sunIconSvg.$moonIconSvg;
?>
<header class="sticky top-0 z-50 border-b border-secondary-200 dark:border-secondary-700 bg-white/95 dark:bg-primary-900/95 backdrop-blur-sm" role="banner">
    <div class="mx-auto max-w-screen-2xl flex items-center justify-between px-4 h-16">
        <?php echo Html::a(
            $brandHtml,
            $homeUrl,
            ['class' => 'flex items-center gap-3 shrink-0'],
        )->encode(false); ?>

        <nav class="hidden md:flex items-center gap-1" role="navigation" aria-label="Navigation principale">
<?php foreach ($navItems as $navItem): ?>
            <?php echo Html::a(
                $navItem['name'],
                $navItem['url'],
                ['class' => 'px-3 py-2 text-sm font-medium text-secondary-600 dark:text-secondary-400 hover:text-secondary-900 dark:hover:text-white rounded-lg hover:bg-secondary-50 dark:hover:bg-secondary-800'],
            )->encode(false); ?>
<?php endforeach; ?>
        </nav>

        <div class="flex items-center gap-2">
<?php foreach ($translations as $translation): ?>
            <?php echo Html::a(
                strtoupper($translation['languageId']),
                $translation['url'],
                ['class' => 'px-2 py-1 text-xs font-mono font-semibold text-secondary-500 dark:text-secondary-400 hover:text-secondary-900 dark:hover:text-white rounded-md hover:bg-secondary-100 dark:hover:bg-secondary-800'],
            ); ?>
<?php endforeach; ?>
            <?php echo Html::button($themeToggleHtml, [
                'class' => 'p-2 text-secondary-500 dark:text-secondary-400 hover:text-secondary-700 dark:hover:text-white rounded-lg hover:bg-secondary-100 dark:hover:bg-secondary-800 cursor-pointer',
                'aria-label' => 'Changer de thème',
                'blackcube-toggle-mode' => '',
            ])->encode(false); ?>
            <?php echo Html::button($burgerIconSvg, [
                'class' => 'md:hidden p-2 text-secondary-500 dark:text-secondary-400 hover:text-secondary-700 dark:hover:text-white rounded-lg hover:bg-secondary-100 dark:hover:bg-secondary-800 cursor-pointer',
                'aria-label' => 'Ouvrir le menu',
                'aria-expanded' => 'false',
                'blackcube-drawer-trigger' => 'open',
            ])->encode(false); ?>
        </div>
    </div>
</header>

<dialog blackcube-drawer class="drawer fixed inset-0 z-50" aria-label="Navigation mobile">
    <div class="drawer-backdrop absolute inset-0 bg-secondary-900/60 backdrop-blur-sm cursor-pointer" blackcube-drawer-trigger="close"></div>
    <nav class="drawer-panel absolute top-0 left-0 bottom-0 w-96 bg-white dark:bg-primary-900 border-r border-secondary-200 dark:border-secondary-700 overflow-y-auto p-4">
        <div class="flex items-center justify-between mb-6">
            <?php echo Html::a(
                $brandHtml,
                $homeUrl,
                ['class' => 'flex items-center gap-3'],
            )->encode(false); ?>
            <?php echo Html::button($closeIconSvg, [
                'class' => 'p-1.5 text-secondary-400 hover:text-secondary-600 dark:hover:text-white rounded-lg hover:bg-secondary-100 dark:hover:bg-secondary-800 cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400',
                'aria-label' => 'Fermer le menu',
                'blackcube-drawer-trigger' => 'close',
                'data-drawer' => 'close',
            ])->encode(false); ?>
        </div>
        <div class="space-y-6 text-sm">
            <div>
                <h3 class="font-semibold text-primary-900 dark:text-white mb-2">Navigation</h3>
                <div class="space-y-1">
<?php foreach ($navItems as $navItem): ?>
                    <?php echo Html::a(
                        $navItem['name'],
                        $navItem['url'],
                        ['class' => 'block px-3 py-1.5 rounded-md text-secondary-600 dark:text-secondary-400 hover:bg-secondary-100 dark:hover:bg-secondary-800'],
                    )->encode(false); ?>
<?php endforeach; ?>
                </div>
            </div>
<?php if ($sidebar !== null): ?>
            <div class="pt-6 border-t border-secondary-200 dark:border-secondary-700">
                <?php echo $sidebar->render(); ?>
            </div>
<?php endif; ?>
        </div>
    </nav>
</dialog>
