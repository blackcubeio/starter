<?php

/**
 * Landing page view.
 *
 * @var \Blackcube\Dcore\Entities\Content|\Blackcube\Dcore\Entities\Tag $element
 * @var \App\Widgets\AbstractWidget|null $hero
 * @var \App\Widgets\AbstractWidget[] $blocs
 */

use App\Widgets\Header;
use App\Widgets\Footer;
use Blackcube\ActiveRecord\Elastic\ElasticInterface;

?>
<?php echo Header::widget()->element($element)->render(); ?>

<main class="mx-auto max-w-screen-xl px-6 lg:px-10 py-10">

<?php if (isset($hero) && $hero instanceof ElasticInterface): ?>
    <?php echo $hero->render(); ?>
<?php endif; ?>

    <div class="mt-8 space-y-6">
<?php foreach ($blocs as $bloc): ?>
        <?php echo $bloc->render(); ?>
<?php endforeach; ?>
    </div>

</main>

<?php echo Footer::widget()->render(); ?>
