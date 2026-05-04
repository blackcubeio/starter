<?php

/**
 * 404 Not Found view.
 *
 * @var \Blackcube\Dcore\Entities\Content|\Blackcube\Dcore\Entities\Tag $element
 * @var \App\Widgets\AbstractWidget|null $hero
 * @var \App\Widgets\AbstractWidget[] $blocs
 * @var Throwable $exception
 * @var string $path
 */

use App\Widgets\Header;
use App\Widgets\Footer;
use App\Widgets\Error;
use Blackcube\ActiveRecord\Elastic\ElasticInterface;

?>
<?php echo Header::widget()->element($element)->render() ?>

<main class="mx-auto max-w-screen-xl px-6 lg:px-10 py-10">

<?php if (isset($hero) && $hero instanceof ElasticInterface): ?>
    <?php echo $hero->render(); ?>
<?php else: ?>
    <!-- Error info -->
    <div class="py-12 text-center">
        <p class="text-8xl md:text-9xl font-extrabold text-primary-100 dark:text-secondary-800 select-none leading-none mb-6">404</p>
        <h1 class="text-2xl md:text-3xl font-bold text-primary-900 dark:text-white tracking-tight mb-4">Page introuvable</h1>
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-secondary-100 dark:bg-secondary-800 border border-secondary-200 dark:border-secondary-700">
            <svg class="w-4 h-4 text-secondary-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
            <code class="text-xs font-mono text-secondary-500 dark:text-secondary-400 truncate max-w-xs"><?php echo \Yiisoft\Html\Html::encode($path) ?></code>
        </div>
    </div>
<?php endif; ?>

    <div class="py-12 text-center">
    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-secondary-100 dark:bg-secondary-800 border border-secondary-200 dark:border-secondary-700">
        <svg class="w-4 h-4 text-secondary-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
        <code class="text-xs font-mono text-secondary-500 dark:text-secondary-400 truncate max-w-xs"><?php echo \Yiisoft\Html\Html::encode($path) ?></code>
    </div>
    </div>

    <div class="mt-8 space-y-6">
<?php foreach ($blocs as $bloc): ?>
   <?php if($bloc instanceof Error): ?>
        <?php echo $bloc->setException($exception)->render(); ?>
    <?php else: ?>
        <?php echo $bloc->render(); ?>
    <?php endif; ?>
<?php endforeach; ?>
    </div>

</main>

<?php echo Footer::widget()->render(); ?>
