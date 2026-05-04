<?php
/**
 * @var \Blackcube\ActiveRecord\Elastic\ElasticInterface[] $elastics
 */

use App\Widgets\Feature;
?>
<div class="flex flex-wrap gap-8">
<?php foreach ($elastics as $elastic): ?>
    <div class="w-full md:w-[calc(50%-1rem)]">
        <?php echo Feature::widget([$elastic])->render() ?>
    </div>
<?php endforeach; ?>
</div>
