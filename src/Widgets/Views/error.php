<?php
/**
 * error.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 * @var Throwable|null $exception
 * @var int|null $httpCode
 * @var string|null $path
 * @var string $locale
 * @var bool $debug
 */

use App\Widgets\Svg;
use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$description = $elastic->description ?? '';

$labels = [
    404 => ['fr' => 'Page introuvable', 'en' => 'Page not found'],
    500 => ['fr' => 'Erreur interne', 'en' => 'Internal error'],
];
$labelDefault = $locale === 'fr' ? 'Erreur' : 'Error';
$label = $httpCode !== null && isset($labels[$httpCode][$locale])
    ? $labels[$httpCode][$locale]
    : $labelDefault;
$homeLabel = $locale === 'fr' ? 'Retour à l\'accueil' : 'Back to home';

$homeIconSvg = Svg::icon('home')->addClass('w-4 h-4')->render();
$linkIconSvg = Svg::icon('link')->addClass('w-4 h-4 text-secondary-400 dark:text-secondary-500 shrink-0')->render();
?>
<section class="mx-auto max-w-screen-md px-6 py-20 text-center">
<?php if ($httpCode !== null): ?>
    <?php echo Html::tag('p', (string) $httpCode, ['class' => 'text-8xl md:text-9xl font-extrabold text-primary-100 dark:text-primary-800 select-none leading-none mb-6'])->encode(false); ?>
<?php endif; ?>
    <?php echo Html::tag('h1', $label, ['class' => 'text-2xl md:text-3xl font-bold text-primary-900 dark:text-white tracking-tight mb-4'])->encode(false); ?>
<?php if (empty($description) === false): ?>
    <?php echo Html::tag('div', Quill::cleanHtml($description), ['class' => 'rich text-secondary-500 dark:text-secondary-400 leading-relaxed mb-8 max-w-md mx-auto space-y-3'])->encode(false); ?>
<?php endif; ?>
    <div class="flex flex-wrap items-center justify-center gap-3 mb-8">
        <?php echo Html::a(
            $homeIconSvg.$homeLabel,
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
<?php if ($debug === true && $exception !== null): ?>
    <div class="mt-12 max-w-full text-left">
<?php
        $current = $exception;
        $depth = 0;
        while ($current !== null):
?>
        <div class="mt-4 font-mono text-xs leading-relaxed border-l-2 border-secondary-300 dark:border-secondary-700 pl-4">
            <p class="uppercase tracking-widest text-secondary-500 dark:text-secondary-400 mb-2">
                <?php echo $depth === 0 ? 'Exception' : 'Caused by'; ?>
<?php if ($current->getCode() !== 0): ?>
                #<?php echo $current->getCode(); ?>
<?php endif; ?>
                <span class="opacity-70">— <?php echo $current::class; ?></span>
            </p>
            <?php echo Html::tag('p', $current->getMessage(), ['class' => 'text-secondary-900 dark:text-white']); ?>
            <p class="mt-1 text-secondary-500 dark:text-secondary-400">
                <?php echo Html::tag('code', $current->getFile().':'.$current->getLine()); ?>
            </p>
            <?php echo Html::tag('pre', $current->getTraceAsString(), ['class' => 'mt-2 overflow-x-auto whitespace-pre text-[11px] text-secondary-500 dark:text-secondary-400']); ?>
        </div>
<?php
            $current = $current->getPrevious();
            $depth++;
        endwhile;
?>
    </div>
<?php endif; ?>
</section>
