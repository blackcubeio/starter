<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */

use App\Helpers\HeadingClass;
use Blackcube\Dcore\Helpers\Element;
use Blackcube\FileProvider\CacheFile;
use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$image = $elastic->image ?? '';
$heroImageSrc = '';
if (empty($image) === false) {
    $heroImageSrc = (string) CacheFile::from($image)->scale(1800);
}

$alt = $elastic->alt ?? '';
$overline = $elastic->overline ?? '';
$title = $elastic->title ?? '';
$description = $elastic->description ?? '';
$label = $elastic->label ?? '';
$secondaryLabel = $elastic->secondaryLabel ?? '';
$ctaUrl = Element::extractUrl($elastic, ['route', 'url']) ?? '';
$secondaryCtaUrl = Element::extractUrl($elastic, ['secondaryRoute', 'secondaryUrl']) ?? '';
?>
<section class="relative overflow-hidden">
<?php if (empty($heroImageSrc) === false): ?>
    <div class="absolute inset-0 pointer-events-none">
        <?php echo Html::img(
            $heroImageSrc,
            $alt,
            [
                'class' => 'w-full h-full object-cover opacity-15 dark:opacity-10 grayscale-85 contrast-105 dark:contrast-95 dark:brightness-85',
                'aria-hidden' => 'true',
            ],
        ); ?>
        <div class="absolute inset-0 bg-gradient-to-r from-secondary-50 via-secondary-50/85 to-transparent dark:from-secondary-900 dark:via-secondary-900/85"></div>
    </div>
<?php endif; ?>
    <div class="relative mx-auto max-w-page w-full px-6 lg:px-10 py-10 lg:py-16 flex flex-col lg:flex-row gap-12 lg:gap-16 items-center">
        <div blackcube-fade-up class="w-full lg:w-2/3 fade-up">
<?php if (empty($overline) === false): ?>
            <p class="font-mono text-xs uppercase tracking-widest opacity-70 mb-8 flex items-center gap-3">
                <span class="inline-block w-6 h-px bg-current"></span>
                <?php echo $overline; ?>
            </p>
<?php endif; ?>
<?php if (empty($title) === false): ?>
            <?php echo Html::tag('h1', $title, ['class' => HeadingClass::for(1)])->encode(false); ?>
<?php endif; ?>
<?php if (empty($description) === false): ?>
            <div class="rich mt-10 max-w-xl text-lg leading-relaxed opacity-85 space-y-4"><?php echo Quill::cleanHtml($description); ?></div>
<?php endif; ?>
<?php if ((empty($ctaUrl) === false && empty($label) === false) || (empty($secondaryCtaUrl) === false && empty($secondaryLabel) === false)): ?>
            <div class="mt-10 flex flex-wrap items-center gap-x-10 gap-y-4">
<?php if (empty($ctaUrl) === false && empty($label) === false): ?>
                <?php echo Html::a(
                    $label.' →',
                    $ctaUrl,
                    ['class' => 'inline-flex items-center gap-2 bg-secondary-900 text-secondary-50 dark:bg-secondary-50 dark:text-secondary-900 px-6 py-3 font-mono text-xs uppercase tracking-widest hover:bg-primary-700 hover:text-secondary-50 dark:hover:bg-primary-300 dark:hover:text-secondary-900 transition-colors'],
                )->encode(false); ?>
<?php endif; ?>
<?php if (empty($secondaryCtaUrl) === false && empty($secondaryLabel) === false): ?>
                <?php echo Html::a(
                    Html::encode($secondaryLabel),
                    $secondaryCtaUrl,
                    ['class' => 'inline-flex items-center gap-2 px-6 py-3 font-mono text-xs uppercase tracking-widest bg-secondary-700 text-secondary-50 dark:bg-secondary-300 dark:text-secondary-900 hover:bg-secondary-600 dark:hover:bg-secondary-400 transition-colors'],
                )->encode(false); ?>
<?php endif; ?>
            </div>
<?php endif; ?>
        </div>
    </div>
</section>
