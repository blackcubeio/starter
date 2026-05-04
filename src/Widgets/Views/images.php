<?php
/**
 * @var \Blackcube\ActiveRecord\Elastic\ElasticInterface[] $elastics
 */

use App\Widgets\Image;
?>
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
<?php foreach ($elastics as $elastic): ?>
    <?php echo Image::widget([$elastic])->render() ?>
<?php endforeach; ?>
</div>
