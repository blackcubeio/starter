<?php
/**
 * @var \Blackcube\ActiveRecord\Elastic\ElasticInterface[] $elastics
 */

use Yiisoft\Html\Html;

$count = count($elastics);
$cols = match (true) {
    $count <= 2 => 'grid-cols-' . $count,
    $count === 3 => 'grid-cols-3',
    default => 'grid-cols-2 md:grid-cols-4',
};
?>
<div class="relative left-1/2 right-1/2 -ml-[50vw] -mr-[50vw] w-screen bg-primary-900 dark:bg-primary-800 px-6 py-16">
    <div class="mx-auto max-w-screen-xl">
        <div class="grid <?php echo $cols ?> gap-8 text-center">
<?php foreach ($elastics as $elastic): ?>
            <div>
                <p class="text-3xl md:text-4xl font-extrabold text-white mb-1"><?php echo Html::encode($elastic->title ?? '') ?></p>
                <p class="text-sm text-primary-200"><?php echo Html::encode($elastic->description ?? '') ?></p>
            </div>
<?php endforeach; ?>
        </div>
    </div>
</div>
