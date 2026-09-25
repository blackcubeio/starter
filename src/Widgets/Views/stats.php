<?php
/**
 * stats.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface[] $elastics
 */

use Yiisoft\Html\Html;

$count = count($elastics);
$gridClass = 'grid grid-cols-2 md:grid-cols-4 gap-8 text-center';
if ($count <= 2) {
    $gridClass = 'grid grid-cols-2 gap-8 text-center';
} elseif ($count === 3) {
    $gridClass = 'grid grid-cols-2 md:grid-cols-3 gap-8 text-center';
}
?>
<section class="bg-primary-900 dark:bg-primary-100">
    <div class="mx-auto max-w-screen-xl px-6 py-4">
        <?php echo Html::openTag('dl', ['blackcube-fade-up' => true, 'class' => 'fade-up '.$gridClass]); ?>
<?php /** @var Blackcube\ActiveRecord\Elastic\ElasticInterface $statElastic */ ?>
<?php foreach ($elastics as $statElastic):
    $statTitle = $statElastic->title ?? '';
    $statDescription = $statElastic->description ?? '';
?>
            <div>
<?php if (empty($statTitle) === false): ?>
                <?php echo Html::tag('dt', $statTitle, ['class' => 'text-3xl md:text-4xl font-extrabold text-white dark:text-primary-900 mb-1'])->encode(false); ?>
<?php endif; ?>
<?php if (empty($statDescription) === false): ?>
                <?php echo Html::tag('dd', $statDescription, ['class' => 'ml-0 text-sm text-primary-200 dark:text-primary-700'])->encode(false); ?>
<?php endif; ?>
            </div>
<?php endforeach; ?>
        <?php echo Html::closeTag('dl'); ?>
    </div>
</section>
