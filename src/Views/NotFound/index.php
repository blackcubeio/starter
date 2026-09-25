<?php
/**
 * index.php
 *
 * PHP Version 8.1
 *
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
use App\Widgets\Svg;
use Yiisoft\Html\Html;

$homeIconSvg = Svg::icon('home')->addClass('w-4 h-4')->render();
$linkIconSvg = Svg::icon('link')->addClass('w-4 h-4 text-secondary-400 dark:text-secondary-500 shrink-0')->render();
?>
<?php echo Header::widget()->element($element)->render(); ?>

<main id="main" role="main">
<?php if ($hero !== null): ?>
    <?php echo $hero->render(); ?>
<?php endif; ?>

<?php if ($hasErrorBloc === false): ?>
    <section class="mx-auto max-w-screen-md px-6 py-20 text-center">
        <p class="text-8xl md:text-9xl font-extrabold text-primary-100 dark:text-primary-800 select-none leading-none mb-6">404</p>
        <h1 class="text-2xl md:text-3xl font-bold text-primary-900 dark:text-white tracking-tight mb-4">Page introuvable</h1>
        <p class="text-secondary-500 dark:text-secondary-400 leading-relaxed mb-8 max-w-md mx-auto">
            La page que vous cherchez n'existe pas ou a été déplacée.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-3 mb-8">
            <?php echo Html::a(
                $homeIconSvg.'Retour à l\'accueil',
                '/',
                ['class' => 'inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-primary-700 hover:bg-primary-800 rounded-lg transition-colors'],
            )->encode(false); ?>
        </div>
<?php if (empty($path) === false): ?>
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-secondary-100 dark:bg-secondary-800 border border-secondary-200 dark:border-secondary-700">
            <?php echo $linkIconSvg; ?>
            <?php echo Html::tag('code', $path, ['class' => 'text-xs font-mono text-secondary-500 dark:text-secondary-400 truncate max-w-xs']); ?>
        </div>
<?php endif; ?>
    </section>
<?php endif; ?>

<?php foreach ($blocs as $bloc): ?>
    <?php echo $bloc->render(); ?>
<?php endforeach; ?>
</main>

<?php echo Footer::widget()->render(); ?>
