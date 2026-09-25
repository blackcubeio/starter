<?php
/**
 * hero.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */

use App\Widgets\Svg;
use Blackcube\Dcore\Helpers\Element;
use Blackcube\FileProvider\CacheFile;
use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$overline = $elastic->overline ?? '';
$title = $elastic->title ?? '';
$description = $elastic->description ?? '';
$image = $elastic->image ?? '';
$alt = $elastic->alt ?? '';
$label = $elastic->label ?? '';
$secondaryLabel = $elastic->secondaryLabel ?? '';
$ctaUrl = Element::extractUrl($elastic, ['route', 'url']) ?? '';
$secondaryCtaUrl = Element::extractUrl($elastic, ['secondaryRoute', 'secondaryUrl']) ?? '';

$heroImageSrc = '';
if (empty($image) === false) {
    $heroImageSrc = (string) CacheFile::from($image)->scale(1800);
}

$hasCta = empty($ctaUrl) === false && empty($label) === false;
$hasSecondaryCta = empty($secondaryCtaUrl) === false && empty($secondaryLabel) === false;
$hasCtas = $hasCta === true || $hasSecondaryCta === true;

$arrowIconSvg = Svg::icon('arrow-right')->addClass('w-4 h-4')->render();
?>
<section class="relative overflow-hidden">
<?php if (empty($heroImageSrc) === false): ?>
    <div class="absolute inset-0 bg-secondary-300 dark:bg-primary-600">
        <?php echo Html::img($heroImageSrc, $alt, ['class' => 'w-full h-full object-cover grayscale-25 contrast-105 dark:brightness-95']); ?>
    </div>
<?php endif; ?>
    <div class="absolute inset-0 bg-primary-900/75 dark:bg-primary-100/95"></div>
    <div blackcube-fade-up class="fade-up relative z-10 mx-auto max-w-screen-xl px-6 md:px-8 py-24 md:py-32 text-center">
<?php if (empty($overline) === false): ?>
        <?php echo Html::tag('p', $overline, ['class' => 'text-sm font-semibold text-primary-200 dark:text-primary-700 uppercase tracking-wider mb-4'])->encode(false); ?>
<?php endif; ?>
        <?php echo Html::tag('h1', $title, ['class' => 'text-4xl md:text-5xl lg:text-6xl font-extrabold text-white dark:text-primary-900 tracking-tight mb-6 max-w-3xl mx-auto leading-tight'])->encode(false); ?>
        <?php echo Html::tag('div', Quill::cleanHtml($description), ['class' => 'rich text-lg md:text-xl text-primary-100 dark:text-primary-800 leading-relaxed max-w-2xl mx-auto mb-10 space-y-4'])->encode(false); ?>
<?php if ($hasCtas === true): ?>
        <div class="flex flex-wrap items-center justify-center gap-4">
<?php if ($hasCta === true): ?>
            <?php echo Html::a(
                $label.$arrowIconSvg,
                $ctaUrl,
                ['class' => 'inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-primary-900 bg-white hover:bg-primary-50 dark:text-white dark:bg-primary-900 dark:hover:bg-primary-800 rounded-lg transition-colors'],
            )->encode(false); ?>
<?php endif; ?>
<?php if ($hasSecondaryCta === true): ?>
            <?php echo Html::a(
                $secondaryLabel,
                $secondaryCtaUrl,
                ['class' => 'inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-secondary-900 bg-secondary-200 hover:bg-secondary-300 dark:text-secondary-50 dark:bg-secondary-700 dark:hover:bg-secondary-800 rounded-lg transition-colors'],
            )->encode(false); ?>
<?php endif; ?>
        </div>
<?php endif; ?>
    </div>
</section>
