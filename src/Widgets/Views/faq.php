<?php
/**
 * faq.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */

use App\Widgets\Svg;
use Blackcube\Ssr\Helpers\Quill;

$title = $elastic->title ?? '';
$description = $elastic->description ?? '';

$chevronIconSvg = Svg::icon('chevron-down')->addClass('w-4 h-4 text-secondary-400 shrink-0 transition-transform group-open:rotate-180')->render();
?>
<section class="mx-auto max-w-screen-xl px-6 py-4">
    <div blackcube-fade-up class="fade-up max-w-3xl mx-auto">
        <details class="group rounded-lg border border-secondary-200 dark:border-secondary-700 bg-secondary-50 dark:bg-primary-800/30">
            <summary class="flex items-center justify-between px-5 py-4 cursor-pointer text-sm font-semibold text-secondary-900 dark:text-white hover:bg-secondary-100 dark:hover:bg-primary-700/30 rounded-lg">
                <span><?php echo $title; ?></span>
                <?php echo $chevronIconSvg; ?>
            </summary>
<?php if (empty($description) === false): ?>
            <div class="rich px-5 pb-4 text-sm text-secondary-600 dark:text-secondary-400 leading-relaxed space-y-3"><?php echo Quill::cleanHtml($description); ?></div>
<?php endif; ?>
        </details>
    </div>
</section>
