<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

/**
 * @var string $homeUrl
 * @var array{name: string, url: string}[] $navItems
 * @var array{languageId: string, url: string}[] $translations
 * @var string|null $sidebar
 */

use Yiisoft\Html\Html;

$brandHtml = '<span class="font-bold text-3xl tracking-tight leading-none">Acme</span>';

$burgerHtml = '<span class="block w-6 h-0.5 bg-current"></span>'
    .'<span class="block w-6 h-0.5 bg-current"></span>'
    .'<span class="block w-6 h-0.5 bg-current"></span>';

$navItemsCount = count($navItems);
?>
<header class="border-b rule sticky top-0 z-40 bg-secondary-50/95 dark:bg-secondary-900/95 backdrop-blur">

    <div class="border-b rule font-mono text-xs uppercase tracking-widest">
        <div class="mx-auto max-w-page w-full px-6 lg:px-10 flex items-center justify-end gap-7 h-9">
<?php foreach ($translations as $translation): ?>
            <?php echo Html::a(
                strtoupper($translation['languageId']),
                $translation['url'],
                ['class' => 'ulink opacity-90'],
            ); ?>
<?php endforeach; ?>
            <?php echo Html::button(
                Html::tag('span', '◐ Dark', ['class' => 'inline dark:hidden'])->render()
                .Html::tag('span', '◑ Light', ['class' => 'hidden dark:inline'])->render(),
                [
                    'class' => 'ulink opacity-90 cursor-pointer',
                    'aria-label' => 'Toggle dark/light',
                    'blackcube-toggle-mode' => '',
                ]
            )->encode(false); ?>
        </div>
    </div>

    <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-6 flex items-center justify-between gap-8">
        <?php echo Html::a(
            $brandHtml,
            $homeUrl,
            ['class' => 'flex items-center gap-3 leading-none shrink-0'],
        )->encode(false); ?>
        <nav class="hidden md:flex items-center gap-9 text-sm tracking-wide">
<?php foreach ($navItems as $navItem): ?>
            <?php echo Html::a(
                $navItem['name'],
                $navItem['url'],
                ['class' => 'ulink'],
            ); ?>
<?php endforeach; ?>
        </nav>
        <?php echo Html::button($burgerHtml, [
            'class' => 'md:hidden flex flex-col gap-1.5 p-2 -mr-2 cursor-pointer',
            'aria-label' => 'Open menu',
            'bleet-burger' => '',
        ])->encode(false); ?>
    </div>

</header>

<aside bleet-menu class="drawer fixed inset-0 z-50 flex flex-col -translate-y-full invisible bg-secondary-900 text-secondary-50 dark:bg-secondary-50 dark:text-secondary-900"
       data-menu-show="translate-y-0 visible"
       data-menu-hide="-translate-y-full invisible"
       data-menu-page-show="no-scroll"
       aria-hidden="true"
       aria-label="Navigation mobile">
    <div class="flex items-center justify-between px-6 h-9 border-b border-current/20 font-mono text-xs uppercase tracking-widest">
        <span class="opacity-70">Menu</span>
        <?php echo Html::button('×', [
            'class' => 'p-2 -mr-2 text-2xl leading-none cursor-pointer rounded-md focus:outline-none focus:ring-2 focus:ring-current',
            'aria-label' => 'Close menu',
            'data-menu' => 'close',
        ]); ?>
    </div>
    <div class="flex items-center justify-between px-6 py-6 border-b border-current/20">
        <span class="font-bold text-2xl tracking-tight">Acme</span>
    </div>
    <div class="flex flex-col flex-1 overflow-y-auto">
        <nav class="flex flex-col px-6 py-8 gap-1">
<?php foreach ($navItems as $navItemIndex => $navItem):
    $linkClass = 'block py-4 text-3xl font-bold tracking-tight';
    if ($navItemIndex < $navItemsCount - 1) {
        $linkClass = $linkClass.' border-b border-current/15';
    }
?>
            <?php echo Html::a(
                $navItem['name'],
                $navItem['url'],
                ['class' => $linkClass],
            ); ?>
<?php endforeach; ?>
        </nav>
<?php if (empty($sidebar) === false): ?>
        <div class="px-6 py-8 border-t border-current/20">
            <?php echo $sidebar; ?>
        </div>
<?php endif; ?>
    </div>
</aside>
