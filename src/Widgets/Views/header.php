<?php
/**
 * @var string $nav
 * @var string $homeUrl
 * @var array{languageId: string, url: string}[] $translations
 * @var array{name: string, url: string|null, items: array{name: string, url: string}[]}[] $sidebarGroups
 */

use Yiisoft\Html\Html;
?>
<header class="sticky top-0 z-50 border-b border-secondary-200 dark:border-secondary-700 bg-white/95 dark:bg-secondary-900/95 backdrop-blur-sm">
    <div class="mx-auto max-w-screen-2xl flex items-center justify-between px-4 h-16">
        <?php echo Html::a(
            '<svg class="w-8 h-8 text-black dark:text-white rounded-lg" viewBox="0 -5 180 165.60001" xmlns="http://www.w3.org/2000/svg"><path d="M 176.4,-5 H 3.6 C 1.6128,-5 0,-3.3872 0,-1.4 V 157 c 0,1.9908 1.6128,3.6 3.6,3.6 h 172.8 c 1.9908,0 3.6,-1.6092 3.6,-3.6 V -1.4 c 0,-1.9872 -1.6092,-3.6 -3.6,-3.6 z m -91.0548,85.3452 -36,36 c -0.702,0.702 -1.6236,1.0548 -2.5452,1.0548 -0.9216,0 -1.8432,-0.3528 -2.5452,-1.0548 -1.4076,-1.4076 -1.4076,-3.6828 0,-5.0904 L 77.7096,77.8 44.2548,44.3452 c -1.4076,-1.4076 -1.4076,-3.6828 0,-5.0904 1.4076,-1.4076 3.6828,-1.4076 5.0904,0 l 36,36 c 1.4076,1.4076 1.4076,3.6828 0,5.0904 z M 133.2,117.4 h -36 c -1.9908,0 -3.6,-1.6092 -3.6,-3.6 0,-1.9908 1.6092,-3.6 3.6,-3.6 h 36 c 1.9908,0 3.6,1.6092 3.6,3.6 0,1.9908 -1.6092,3.6 -3.6,3.6 z" fill="currentColor" stroke-width="3.5"/></svg>'
            . '<span class="font-bold text-lg text-primary-900 dark:text-white tracking-tight">Blackcube</span>',
            $homeUrl,
            ['class' => 'flex items-center gap-3 shrink-0'],
        )->encode(false); ?>
        <?php echo $nav ?>
        <div class="flex items-center gap-2">
            <button class="hidden sm:flex items-center gap-2 px-3 py-1.5 text-sm text-secondary-400 dark:text-secondary-500 border border-secondary-200 dark:border-secondary-700 rounded-lg hover:border-secondary-300 dark:hover:border-secondary-600 bg-secondary-50 dark:bg-secondary-800 min-w-48">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <span>Rechercher…</span>
                <kbd class="ml-auto text-xs font-mono text-secondary-400 dark:text-secondary-500 border border-secondary-200 dark:border-secondary-600 rounded px-1.5 py-0.5">⌘K</kbd>
            </button>
            <?php foreach ($translations as $translation):
                $globe = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>';
                echo Html::a(
                    $globe . ' <span class="text-xs font-semibold uppercase">' . Html::encode($translation['languageId']) . '</span>',
                    $translation['url'],
                    ['class' => 'flex items-center gap-1 px-2 py-1.5 text-secondary-500 dark:text-secondary-400 hover:text-secondary-700 dark:hover:text-white rounded-lg hover:bg-secondary-100 dark:hover:bg-secondary-800'],
                )->encode(false);
            endforeach; ?>
            <button dark-toggle class="cursor-pointer p-2 text-secondary-500 dark:text-secondary-400 hover:text-secondary-700 dark:hover:text-white rounded-lg hover:bg-secondary-100 dark:hover:bg-secondary-800" aria-label="Toggle theme">
                <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            </button>
            <button mobile-menu="mobile-drawer" class="cursor-pointer md:hidden p-2 text-secondary-500 dark:text-secondary-400 hover:text-secondary-700 dark:hover:text-white rounded-lg hover:bg-secondary-100 dark:hover:bg-secondary-800" aria-label="Menu">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>
</header>
<aside id="mobile-drawer" class="fixed inset-0 z-40 hidden" aria-label="Navigation mobile">
    <div class="absolute inset-0 bg-secondary-900/60 backdrop-blur-sm opacity-0 transition-opacity duration-300" data-mobile-backdrop></div>
    <nav class="absolute top-0 left-0 bottom-0 w-72 bg-white dark:bg-secondary-900 border-r border-secondary-200 dark:border-secondary-700 overflow-y-auto p-4 -translate-x-full transition-transform duration-300">
        <div class="flex items-center justify-between mb-6">
            <span class="font-bold text-primary-900 dark:text-white">Navigation</span>
            <button class="p-1.5 text-secondary-400 hover:text-secondary-600 dark:hover:text-white rounded-lg hover:bg-secondary-100 dark:hover:bg-secondary-800 cursor-pointer" data-mobile-close aria-label="Close">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="space-y-6 text-sm">
<?php foreach ($sidebarGroups as $group): ?>
            <div>
<?php if ($group['url'] !== null):
    echo '                ' . Html::a(Html::encode($group['name']), $group['url'], ['class' => 'block font-semibold text-primary-900 dark:text-white mb-2 hover:text-primary-700 dark:hover:text-primary-400']) . "\n";
else: ?>
                <h3 class="font-semibold text-primary-900 dark:text-white mb-2"><?php echo Html::encode($group['name']); ?></h3>
<?php endif; ?>
                <div class="space-y-1">
<?php foreach ($group['items'] as $item):
    echo '                    ' . Html::a(Html::encode($item['name']), $item['url'], ['class' => 'block px-3 py-1.5 rounded-md text-secondary-600 dark:text-secondary-400 hover:bg-secondary-100 dark:hover:bg-secondary-800']) . "\n";
endforeach; ?>
                </div>
            </div>
<?php endforeach; ?>
        </div>
    </nav>
</aside>
