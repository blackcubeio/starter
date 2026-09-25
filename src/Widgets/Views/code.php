<?php
/**
 * code.php
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
use Yiisoft\Html\Html;

$language = $elastic->language ?? 'text';
$filename = $elastic->filename ?? '';
$code = $elastic->code ?? '';

$headerLabel = '';
if (empty($filename) === false && empty($language) === false) {
    $headerLabel = $filename.' · '.$language;
} elseif (empty($filename) === false) {
    $headerLabel = $filename;
} elseif (empty($language) === false) {
    $headerLabel = $language;
}

$copyIconSvg = Svg::icon('document-duplicate')
    ->addClass('w-3.5 h-3.5')
    ->attribute('data-code-highlight', 'icon-copy')
    ->render();
$copiedIconSvg = Svg::icon('document-check')
    ->addClass('w-3.5 h-3.5 hidden transition duration-300')
    ->attribute('data-code-highlight', 'icon-copied')
    ->render();
?>
<section class="mx-auto max-w-screen-xl px-6 py-4">
    <div blackcube-fade-up class="fade-up max-w-3xl mx-auto rounded-xl overflow-hidden border border-secondary-700 dark:border-secondary-300 bg-secondary-900 dark:bg-secondary-100">
        <div class="group">
            <div class="flex items-center justify-between px-4 py-2.5 bg-secondary-800 dark:bg-secondary-200 border-b border-secondary-700 dark:border-secondary-300">
<?php if (empty($headerLabel) === false): ?>
                <?php echo Html::tag('span', $headerLabel, ['class' => 'text-xs font-mono text-secondary-200 dark:text-secondary-700'])->encode(false); ?>
<?php else: ?>
                <span></span>
<?php endif; ?>
                <?php echo Html::button($copyIconSvg.$copiedIconSvg, [
                    'type' => 'button',
                    'data-code-highlight' => 'copy',
                    'class' => 'text-secondary-400 dark:text-secondary-500 hover:text-white dark:hover:text-secondary-900 flex items-center cursor-pointer',
                ])->encode(false); ?>
            </div>
            <?php echo Html::openTag('pre', ['code-highlight' => $language, 'class' => 'p-4 overflow-x-auto text-sm leading-relaxed font-mono m-0']); ?><?php echo Html::tag('code', $code, ['class' => 'language-'.$language]); ?><?php echo Html::closeTag('pre'); ?>
        </div>
    </div>
</section>
