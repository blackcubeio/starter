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

use Blackcube\FileProvider\CacheFile;
use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$position = $elastic->position ?? 'right';
if ($position !== 'left') {
    $position = 'right';
}

$contentImageSrc = '';
$image = $elastic->image ?? '';
if (empty($image) === false) {
    $contentImageSrc = (string) CacheFile::from($image)->scale(1024);
}

$alt = $elastic->alt ?? '';
$description = $elastic->description ?? '';

$hasImage = empty($contentImageSrc) === false;
$rowClass = $position === 'left'
    ? 'flex flex-col lg:flex-row-reverse gap-10 lg:gap-16 items-center'
    : 'flex flex-col lg:flex-row gap-10 lg:gap-16 items-center';
$textClass = $hasImage
    ? 'rich w-full lg:w-1/2 space-y-4 text-base leading-relaxed'
    : 'rich w-full lg:w-2/3 space-y-4 text-base leading-relaxed';
?>
<section>
    <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-10 lg:py-14">
    <?php echo Html::openTag('div', [
        'blackcube-fade-up' => true,
        'class' => $rowClass.' fade-up',
    ]); ?>
<?php if (empty($description) === false): ?>
        <?php echo Html::openTag('div', ['class' => $textClass]); ?>
            <?php echo Quill::cleanHtml($description); ?>
        <?php echo Html::closeTag('div'); ?>
<?php endif; ?>
<?php if ($hasImage === true): ?>
        <div class="w-full lg:w-1/2">
            <div class="aspect-square overflow-hidden border rule">
                <?php echo Html::img(
                    $contentImageSrc,
                    $alt,
                    ['class' => 'w-full h-full object-cover grayscale-85 contrast-105 dark:contrast-95 dark:brightness-85'],
                ); ?>
            </div>
        </div>
<?php endif; ?>
    <?php echo Html::closeTag('div'); ?>
    </div>
</section>
