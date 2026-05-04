<?php
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */

use Yiisoft\Html\Html;
?>
<div class="rounded-xl bg-primary-900 dark:bg-primary-800 px-6 py-10 text-center">
<?php if (isset($elastic->title) && !empty($elastic->title)): ?>
    <p class="text-3xl md:text-4xl font-extrabold text-white mb-1"><?php echo Html::encode($elastic->title) ?></p>
<?php endif; ?>
<?php if (isset($elastic->description) && !empty($elastic->description)): ?>
    <p class="text-sm text-primary-200"><?php echo Html::encode($elastic->description) ?></p>
<?php endif; ?>
</div>
