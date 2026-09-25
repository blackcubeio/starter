<?php
/**
 * image.php
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

use Blackcube\FileProvider\CacheFile;
use Yiisoft\Html\Html;

$image = $elastic->image ?? '';
$alt = $elastic->alt ?? '';
$description = $elastic->description ?? '';

$imageSrc = '';
if (empty($image) === false) {
    $imageSrc = (string) CacheFile::from($image)->scale(1600);
}

$hasImage = empty($imageSrc) === false;
?>
<section class="mx-auto max-w-screen-xl px-6 py-4">
    <figure blackcube-fade-up class="fade-up max-w-3xl mx-auto">
<?php if ($hasImage === true): ?>
        <?php echo Html::a(
            Html::img($imageSrc, $alt, ['class' => 'w-full rounded-xl border border-secondary-200 dark:border-secondary-700 grayscale-25 contrast-105 dark:brightness-95'])->render(),
            $imageSrc,
            ['target' => '_blank', 'rel' => 'noopener'],
        )->encode(false); ?>
<?php else: ?>
        <div class="w-full aspect-video rounded-xl border border-secondary-200 dark:border-secondary-700 bg-secondary-100 dark:bg-secondary-800 flex items-center justify-center">
            <?php echo Html::tag('span', empty($alt) === false ? $alt : 'image', ['class' => 'text-sm font-mono text-secondary-400 dark:text-secondary-500'])->encode(false); ?>
        </div>
<?php endif; ?>
<?php if (empty($description) === false): ?>
        <?php echo Html::tag('figcaption', $description, ['class' => 'mt-3 text-sm text-secondary-500 dark:text-secondary-400'])->encode(false); ?>
<?php endif; ?>
    </figure>
</section>
