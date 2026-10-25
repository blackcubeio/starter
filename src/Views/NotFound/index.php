<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

/**
 * @var Blackcube\Dcore\Entities\Content|Blackcube\Dcore\Entities\Tag $element
 * @var App\Widgets\AbstractWidget|null $hero
 * @var array<App\Widgets\AbstractWidget|App\Widgets\AbstractGroupWidget> $blocs
 * @var string $path
 * @var bool $hasErrorBloc
 */

use App\Widgets\Footer;
use App\Widgets\Header;
?>
<?php echo Header::widget()->element($element)->render(); ?>

<main>
<?php if ($hero !== null): ?>
    <?php echo $hero->render(); ?>
<?php endif; ?>

<?php if ($hasErrorBloc === false): ?>
    <section class="border-b rule">
        <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-20 lg:py-28">
            <p class="font-mono text-xs uppercase tracking-widest opacity-60 mb-8 flex items-center gap-3">
                <span class="inline-block w-6 h-px bg-current"></span>
                404 — Page introuvable
            </p>
            <p class="font-bold tracking-tight leading-none text-7xl sm:text-8xl md:text-9xl opacity-15 select-none">404</p>
            <h1 class="mt-6 font-bold tracking-tight leading-none text-3xl sm:text-4xl md:text-5xl lg:text-6xl">
                Page introuvable
            </h1>
            <p class="mt-6 max-w-2xl text-base leading-relaxed opacity-85">
                La page que vous cherchez n'existe pas ou a été déplacée.
            </p>
            <div class="mt-6 inline-flex items-center gap-3 font-mono text-xs uppercase tracking-widest opacity-70 max-w-full">
                <span class="opacity-60">URL :</span>
                <code class="truncate"><?php echo $path; ?></code>
            </div>
            <div class="mt-10">
                <a href="/" class="inline-flex items-center gap-2 bg-secondary-900 text-secondary-50 dark:bg-secondary-50 dark:text-secondary-900 px-6 py-3 font-mono text-xs uppercase tracking-widest hover:bg-primary-700 hover:text-secondary-50 dark:hover:bg-primary-300 dark:hover:text-secondary-900 transition-colors">
                    Retour à l'accueil →
                </a>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php foreach ($blocs as $bloc): ?>
    <?php echo $bloc->render(); ?>
<?php endforeach; ?>
</main>

<?php echo Footer::widget()->render(); ?>
