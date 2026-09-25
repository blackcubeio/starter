<?php
/**
 * prev-next.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
/**
 * @var Blackcube\Dcore\Entities\Content|Blackcube\Dcore\Entities\Tag|null $prev
 * @var Blackcube\Dcore\Entities\Content|Blackcube\Dcore\Entities\Tag|null $next
 * @var string|null $prevUrl
 * @var string|null $nextUrl
 */

use Yiisoft\Html\Html;

$prevArrow = '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>';
$nextArrow = '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>';
$linkClass = 'group basis-1/2 shrink-0 flex flex-col p-4 rounded-lg border border-secondary-200 dark:border-secondary-700 hover:border-primary-300 dark:hover:border-primary-600 hover:bg-primary-50/50 dark:hover:bg-primary-900/20 transition-colors';
?>
<nav class="flex gap-4 pt-8 border-t border-secondary-200 dark:border-secondary-700">
    <?php if ($prevUrl !== null):
        echo Html::a(
            '<span class="text-xs text-secondary-400 dark:text-secondary-500 mb-1 flex items-center gap-1">'
            .$prevArrow.' Previous</span>'
            .'<span class="text-sm font-semibold text-secondary-900 dark:text-white group-hover:text-primary-700 dark:group-hover:text-primary-400">'
            .Html::encode($prev->getName()).'</span>',
            $prevUrl,
            ['class' => $linkClass.' items-start mr-auto'],
        )->encode(false);
    endif; ?>
    <?php if ($nextUrl !== null):
        echo Html::a(
            '<span class="text-xs text-secondary-400 dark:text-secondary-500 mb-1 flex items-center gap-1">Next '
            .$nextArrow.'</span>'
            .'<span class="text-sm font-semibold text-secondary-900 dark:text-white group-hover:text-primary-700 dark:group-hover:text-primary-400">'
            .Html::encode($next->getName()).'</span>',
            $nextUrl,
            ['class' => $linkClass.' items-end ml-auto'],
        )->encode(false);
    endif; ?>
</nav>
