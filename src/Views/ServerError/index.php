<?php

/**
 * 500 Server Error view.
 *
 * @var \Blackcube\Dcore\Entities\Content|\Blackcube\Dcore\Entities\Tag $element
 * @var \App\Widgets\AbstractWidget|null $hero
 * @var \App\Widgets\AbstractWidget[] $blocs
 */

use App\Widgets\Header;
use App\Widgets\Footer;
use Blackcube\ActiveRecord\Elastic\ElasticInterface;

?>
<?php echo Header::widget()->element($element)->render() ?>

<main class="mx-auto max-w-screen-xl px-6 lg:px-10 py-10">

<?php if (isset($hero) && $hero instanceof ElasticInterface): ?>
    <?php echo $hero->render(); ?>
<?php endif; ?>

    <!-- Error info -->
    <div class="py-12 text-center">
        <p class="text-8xl md:text-9xl font-extrabold text-danger-100 dark:text-danger-800/40 select-none leading-none mb-6">500</p>
        <h1 class="text-2xl md:text-3xl font-bold text-primary-900 dark:text-white tracking-tight mb-4">Erreur interne</h1>
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-secondary-100 dark:bg-secondary-800 border border-secondary-200 dark:border-secondary-700">
            <svg class="w-4 h-4 text-secondary-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <code class="text-xs font-mono text-secondary-500 dark:text-secondary-400"><?php echo date('Y-m-d H:i:s') ?> UTC</code>
        </div>
    </div>

    <div class="mt-8 space-y-6">
<?php foreach ($blocs as $bloc): ?>
        <?php echo $bloc->render(); ?>
<?php endforeach; ?>
    </div>

</main>

<?php echo Footer::widget()->render(); ?>
