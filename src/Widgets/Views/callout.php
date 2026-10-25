<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */

use App\Helpers\HeadingClass;
use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$level = $elastic->level ?? 'info';
if (in_array($level, ['info', 'success', 'warning', 'danger'], true) === false) {
    $level = 'info';
}

$wrapperClass = match ($level) {
    'success' => 'border-l-4 border-success-500 bg-success-50 dark:bg-success-900/30 p-6 flex flex-col gap-2',
    'warning' => 'border-l-4 border-warning-500 bg-warning-50 dark:bg-warning-900/30 p-6 flex flex-col gap-2',
    'danger' => 'border-l-4 border-danger-500 bg-danger-50 dark:bg-danger-900/30 p-6 flex flex-col gap-2',
    default => 'border-l-4 border-info-500 bg-info-50 dark:bg-info-900/30 p-6 flex flex-col gap-2',
};

$title = $elastic->title ?? '';
$description = $elastic->description ?? '';
?>
<section>
    <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-12">
    <?php echo Html::openTag('div', [
        'blackcube-fade-up' => true,
        'class' => $wrapperClass.' fade-up',
    ]); ?>
<?php if (empty($title) === false): ?>
        <?php echo Html::tag('h4', $title, ['class' => HeadingClass::for(4)])->encode(false); ?>
<?php endif; ?>
<?php if (empty($description) === false): ?>
        <div class="rich text-sm leading-relaxed opacity-90 space-y-3"><?php echo Quill::cleanHtml($description); ?></div>
<?php endif; ?>
    <?php echo Html::closeTag('div'); ?>
    </div>
</section>
