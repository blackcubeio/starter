<?php
/**
 * footer.php
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
 */

use App\Widgets\Svg;
use Yiisoft\Html\Html;

$logoSvg = Svg::logo('blackcube')->addClass('w-8 h-8 rounded-md overflow-hidden text-secondary-900 dark:text-white')->render();

$brandHtml = $logoSvg
    .Html::tag('span', 'Blackcube', ['class' => 'font-bold text-lg text-primary-900 dark:text-white tracking-tight']);
?>
<footer class="border-t border-secondary-200 dark:border-secondary-700 bg-secondary-50 dark:bg-primary-900 mt-16" role="contentinfo">
    <div class="mx-auto max-w-screen-2xl px-6 py-12">
        <div class="flex flex-col md:flex-row gap-10 md:gap-16">
            <div class="md:w-64 shrink-0">
                <?php echo Html::a(
                    $brandHtml,
                    $homeUrl,
                    ['class' => 'flex items-center gap-3 mb-4'],
                )->encode(false); ?>
                <p class="text-sm text-secondary-500 dark:text-secondary-400 leading-relaxed">Le CMS PHP structuré pour durer.</p>
            </div>
            <div class="flex-1">
                <h4 class="font-semibold text-secondary-900 dark:text-white mb-3 text-sm">Navigation</h4>
                <div class="flex flex-wrap gap-x-8 gap-y-2 text-sm">
<?php foreach ($navItems as $navItem): ?>
                    <?php echo Html::a(
                        $navItem['name'],
                        $navItem['url'],
                        ['class' => 'block text-secondary-500 dark:text-secondary-400 hover:text-primary-700 dark:hover:text-primary-400'],
                    )->encode(false); ?>
<?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row items-center justify-between mt-10 pt-6 border-t border-secondary-200 dark:border-secondary-700 text-xs text-secondary-400 dark:text-secondary-500">
            <p>&copy; <?php echo date('Y'); ?> Blackcube. Tous droits réservés.</p>
            <p class="mt-2 sm:mt-0">Construit avec Blackcube CMS.</p>
        </div>
    </div>
</footer>
