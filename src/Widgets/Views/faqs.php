<?php
/**
 * @var \Blackcube\ActiveRecord\Elastic\ElasticInterface[] $elastics
 * @var \Blackcube\ActiveRecord\Elastic\ElasticInterface|null $header
 */

use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$heading = null;
$headingLevel = 'h2';
$headingClass = 'text-2xl';
if ($header !== null) {
    $heading = $header->title ?? null;
    $level = (int) ($header->level ?? 2);
    $headingLevel = 'h' . max(2, min(6, $level));
    $headingClass = match ($level) {
        2 => 'text-2xl',
        3 => 'text-xl',
        4 => 'text-lg',
        5 => 'text-base',
        6 => 'text-sm',
        default => 'text-2xl',
    };
}
?>
<div class="rounded-xl border border-secondary-200 dark:border-secondary-700 bg-secondary-50 dark:bg-secondary-800/30 p-8">
<?php if ($heading !== null): ?>
    <?php echo Html::openTag($headingLevel, ['class' => $headingClass . ' font-bold text-primary-900 dark:text-white tracking-tight' . (($headerDescription = $header->description ?? null) ? ' mb-2' : ' mb-6')]) ?>
        <?php echo Html::encode($heading) ?>
    <?php echo Html::closeTag($headingLevel) ?>
<?php if ($headerDescription): ?>
    <div class="italic text-sm text-secondary-500 dark:text-secondary-400 leading-relaxed mb-6">
        <?php echo Quill::cleanHtml($headerDescription) ?>
    </div>
<?php endif; ?>
<?php else: ?>
    <p class="text-xl font-bold text-primary-900 dark:text-white tracking-tight mb-6"><?php echo $locale === 'fr' ? 'Questions fréquentes' : 'Frequently asked questions'; ?></p>
<?php endif; ?>
    <div class="divide-y divide-secondary-200 dark:divide-secondary-700">
<?php foreach ($elastics as $elastic): ?>
        <details class="group">
            <summary class="flex items-center justify-between py-4 cursor-pointer text-sm font-semibold text-secondary-900 dark:text-white">
                <?php echo $elastic->title ?? '' ?>
                <svg class="w-4 h-4 text-secondary-400 shrink-0 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </summary>
            <div class="pb-4 text-sm text-secondary-600 dark:text-secondary-400 leading-relaxed"><?php echo Quill::cleanHtml($elastic->description ?? '') ?></div>
        </details>
<?php endforeach; ?>
    </div>
</div>
