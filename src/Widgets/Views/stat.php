<?php
/**
 * stat.php
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

use Yiisoft\Html\Html;

$title = $elastic->title ?? '';
$description = $elastic->description ?? '';
?>
<section class="bg-primary-900 dark:bg-primary-100">
    <div class="mx-auto max-w-screen-xl px-6 py-4">
        <?php echo Html::openTag('dl', ['blackcube-fade-up' => true, 'class' => 'fade-up text-center max-w-md mx-auto']); ?>
<?php if (empty($title) === false): ?>
            <?php echo Html::tag('dt', $title, ['class' => 'text-4xl md:text-5xl font-extrabold text-white dark:text-primary-900 mb-2'])->encode(false); ?>
<?php endif; ?>
<?php if (empty($description) === false): ?>
            <?php echo Html::tag('dd', $description, ['class' => 'ml-0 text-sm text-primary-200 dark:text-primary-700'])->encode(false); ?>
<?php endif; ?>
        <?php echo Html::closeTag('dl'); ?>
    </div>
</section>
