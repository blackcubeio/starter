<?php
/**
 * images.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface[] $elastics
 */

use App\Widgets\Svg;
use Blackcube\Dcore\Helpers\Element;
use Blackcube\FileProvider\CacheFile;
use Yiisoft\Html\Html;

$arrowIconSvg = Svg::icon('arrow-right')->addClass('w-4 h-4')->render();

$gridClass = (count($elastics) <= 2)
    ? 'grid md:grid-cols-2 gap-8'
    : 'grid md:grid-cols-2 lg:grid-cols-3 gap-8';
?>
<section class="mx-auto max-w-screen-xl px-6 py-4">
    <?php echo Html::openTag('div', ['class' => $gridClass]); ?>
<?php /** @var Blackcube\ActiveRecord\Elastic\ElasticInterface $imageElastic */ ?>
<?php foreach ($elastics as $imageElastic):
    $imageFile = $imageElastic->image ?? '';
    $imageAlt = $imageElastic->alt ?? '';
    $imageDescription = $imageElastic->description ?? '';
    $imageLabel = $imageElastic->label ?? '';
    $imageUrl = Element::extractUrl($imageElastic, ['route', 'url']) ?? '';

    $imageSrc = '';
    if (empty($imageFile) === false) {
        $imageSrc = (string) CacheFile::from($imageFile)->scale(1024);
    }
    $hasImage = empty($imageSrc) === false;
    $imageHasCta = empty($imageUrl) === false && empty($imageLabel) === false;
?>
        <figure blackcube-fade-up class="fade-up">
<?php if ($hasImage === true): ?>
            <?php echo Html::img($imageSrc, $imageAlt, ['class' => 'w-full rounded-xl border border-secondary-200 dark:border-secondary-700 grayscale-25 contrast-105 dark:brightness-95']); ?>
<?php else: ?>
            <div class="w-full aspect-video rounded-xl border border-secondary-200 dark:border-secondary-700 bg-secondary-100 dark:bg-secondary-800 flex items-center justify-center">
                <?php echo Html::tag('span', empty($imageAlt) === false ? $imageAlt : 'image', ['class' => 'text-sm font-mono text-secondary-400 dark:text-secondary-500'])->encode(false); ?>
            </div>
<?php endif; ?>
<?php if (empty($imageDescription) === false): ?>
            <?php echo Html::tag('figcaption', $imageDescription, ['class' => 'mt-3 text-sm text-secondary-500 dark:text-secondary-400'])->encode(false); ?>
<?php endif; ?>
<?php if ($imageHasCta === true): ?>
            <?php echo Html::a(
                $imageLabel.$arrowIconSvg,
                $imageUrl,
                ['class' => 'inline-flex items-center gap-1 mt-3 text-sm font-medium text-primary-700 dark:text-primary-300 hover:text-primary-800 dark:hover:text-primary-200 transition-colors'],
            )->encode(false); ?>
<?php endif; ?>
        </figure>
<?php endforeach; ?>
    <?php echo Html::closeTag('div'); ?>
</section>
