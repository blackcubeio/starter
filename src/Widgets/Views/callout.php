<?php
/**
 * @var \Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */

use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$outerClass = match ($elastic->level) {
    'info' => 'border-info-500 bg-info-50 dark:bg-info-900/20',
    'success' => 'border-success-500 bg-success-50 dark:bg-success-900/20',
    'warning' => 'border-warning-500 bg-warning-50 dark:bg-warning-900/20',
    'danger' => 'border-danger-500 bg-danger-50 dark:bg-danger-900/20',
    default => 'border-info-500 bg-info-50 dark:bg-info-900/20',
};
$titleClass = match ($elastic->level) {
    'info' => 'text-info-800 dark:text-info-300',
    'success' => 'text-success-800 dark:text-success-300',
    'warning' => 'text-warning-800 dark:text-warning-300',
    'danger' => 'text-danger-800 dark:text-danger-300',
    default => 'text-info-800 dark:text-info-300',
};

$descriptionClass = match ($elastic->level) {
    'info' => 'text-info-700 dark:text-info-400',
    'success' => 'text-success-700 dark:text-success-400',
    'warning' => 'text-warning-700 dark:text-warning-400',
    'danger' => 'text-danger-700 dark:text-danger-400',
    default => 'text-info-700 dark:text-info-400',
};

$svg = match ($elastic->level) {
    'info' => '<svg class="w-5 h-5 text-info-600 dark:text-info-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
    'success' => '<svg class="w-5 h-5 text-success-600 dark:text-success-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
    'warning' => '<svg class="w-5 h-5 text-warning-600 dark:text-warning-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>',
    'danger' => '<svg class="w-5 h-5 text-danger-600 dark:text-danger-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>',
    default => '<svg class="w-5 h-5 text-info-600 dark:text-info-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
};
?>
<div class="p-8 space-y-4">

<?php echo Html::openTag('div', [
    'class' => 'rounded-lg border-l-4 '.$outerClass.' p-4',
]); ?>
    <div class="flex items-start gap-3">
        <?php echo $svg; ?>
        <div>
            <?php if(isset($elastic->title) && !empty($elastic->title)): ?>
            <?php echo Html::openTag('p', ['class' => 'font-semibold '.$titleClass.' text-sm mb-1']); ?>
                <?php echo $elastic->title; ?>
            <?php echo Html::closeTag('p'); ?>
            <?php endif; ?>
            <?php if(isset($elastic->description) && !empty($elastic->description)): ?>
            <?php echo Html::openTag('div', ['class' => $descriptionClass.' text-sm leading-relaxed']); ?>
                <?php echo Quill::cleanHtml($elastic->description); ?>
            <?php echo Html::closeTag('div'); ?>
            <?php endif; ?>
        </div>
    </div>
<?php echo Html::closeTag('div'); ?>

</div>