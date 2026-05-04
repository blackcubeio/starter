<?php
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */

use Yiisoft\Html\Html;

$heading = match ($elastic->level) {
    2 => 'h2',
    3 => 'h3',
    4 => 'h4',
    5 => 'h5',
    6 => 'h6',
    default => 'h2',
};
$headingClass = match ($elastic->level) {
    2 => 'text-2xl',
    3 => 'text-xl',
    4 => 'text-lg',
    5 => 'text-base',
    6 => 'text-sm',
    default => 'text-2xl',
};
?>
<div class="p-4">
    <?php if (isset($elastic->title) && !empty($elastic->title)): ?>
    <?php echo Html::openTag($heading, ['class' => $headingClass . ' font-bold text-primary-900 dark:text-white tracking-tight mb-3']); ?>
        <?php echo $elastic->title; ?>
    <?php echo Html::closeTag($heading); ?>
    <?php endif; ?>
    <?php if (isset($elastic->description) && !empty($elastic->description)): ?>
    <div class="text-secondary-600 dark:text-secondary-400 leading-relaxed">
        <?php echo $elastic->description; ?>
    </div>
    <?php endif; ?>
</div>