<?php
/**
 * callout.php
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
use Yiisoft\Html\Html;

$level = $elastic->level ?? 'info';
if (in_array($level, ['info', 'success', 'warning', 'danger'], true) === false) {
    $level = 'info';
}

$iconName = match ($level) {
    'success' => 'check-circle',
    'warning' => 'exclamation-triangle',
    'danger' => 'x-circle',
    default => 'information-circle',
};

$wrapperClass = match ($level) {
    'success' => 'rounded-lg border-l-4 border-success-500 bg-success-50 dark:bg-success-900/20 p-4',
    'warning' => 'rounded-lg border-l-4 border-warning-500 bg-warning-50 dark:bg-warning-900/20 p-4',
    'danger' => 'rounded-lg border-l-4 border-danger-500 bg-danger-50 dark:bg-danger-900/20 p-4',
    default => 'rounded-lg border-l-4 border-info-500 bg-info-50 dark:bg-info-900/20 p-4',
};

$iconClass = match ($level) {
    'success' => 'w-5 h-5 mt-0.5 shrink-0 text-success-600 dark:text-success-400',
    'warning' => 'w-5 h-5 mt-0.5 shrink-0 text-warning-600 dark:text-warning-400',
    'danger' => 'w-5 h-5 mt-0.5 shrink-0 text-danger-600 dark:text-danger-400',
    default => 'w-5 h-5 mt-0.5 shrink-0 text-info-600 dark:text-info-400',
};

$titleClass = match ($level) {
    'success' => 'font-semibold text-sm mb-1 text-success-800 dark:text-success-300',
    'warning' => 'font-semibold text-sm mb-1 text-warning-800 dark:text-warning-300',
    'danger' => 'font-semibold text-sm mb-1 text-danger-800 dark:text-danger-300',
    default => 'font-semibold text-sm mb-1 text-info-800 dark:text-info-300',
};

$descriptionClass = match ($level) {
    'success' => 'rich text-sm leading-relaxed space-y-2 text-success-700 dark:text-success-400',
    'warning' => 'rich text-sm leading-relaxed space-y-2 text-warning-700 dark:text-warning-400',
    'danger' => 'rich text-sm leading-relaxed space-y-2 text-danger-700 dark:text-danger-400',
    default => 'rich text-sm leading-relaxed space-y-2 text-info-700 dark:text-info-400',
};

$title = $elastic->title ?? '';
$description = $elastic->description ?? '';
$iconSvg = Svg::icon($iconName)->addClass($iconClass)->render();
?>
<section class="mx-auto max-w-screen-xl px-6 py-4">
    <div blackcube-fade-up class="fade-up max-w-3xl mx-auto">
        <?php echo Html::openTag('div', ['class' => $wrapperClass]); ?>
            <div class="flex items-start gap-3">
                <?php echo $iconSvg; ?>
                <div class="flex-1">
<?php if (empty($title) === false): ?>
                    <?php echo Html::tag('p', $title, ['class' => $titleClass])->encode(false); ?>
<?php endif; ?>
<?php if (empty($description) === false): ?>
                    <?php echo Html::tag('div', Quill::cleanHtml($description), ['class' => $descriptionClass])->encode(false); ?>
<?php endif; ?>
                </div>
            </div>
        <?php echo Html::closeTag('div'); ?>
    </div>
</section>
