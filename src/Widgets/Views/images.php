<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface[] $elastics
 */

use Blackcube\FileProvider\CacheFile;
use Yiisoft\Html\Html;
?>
<section class="bg-secondary-100 dark:bg-secondary-800">
    <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-10 lg:py-14">
    <div class="flex flex-wrap -mx-2 -my-2">
<?php /** @var Blackcube\ActiveRecord\Elastic\ElasticInterface $imageElastic */ ?>
<?php foreach ($elastics as $imageElastic):
    $imageBin = $imageElastic->image ?? '';
    $imageItemSrc = '';
    if (empty($imageBin) === false) {
        $imageItemSrc = (string) CacheFile::from($imageBin)->scale(1024);
    }
    $imageAlt = $imageElastic->alt ?? '';
    $imageCaption = $imageElastic->description ?? '';
?>
        <figure blackcube-fade-up class="w-full sm:w-1/2 lg:w-1/3 px-2 py-2 fade-up">
            <div class="aspect-square overflow-hidden border rule">
<?php if (empty($imageItemSrc) === false): ?>
                <?php echo Html::img(
                    $imageItemSrc,
                    $imageAlt,
                    ['class' => 'w-full h-full object-cover grayscale-85 contrast-105 dark:contrast-95 dark:brightness-85'],
                ); ?>
<?php else: ?>
                <div class="w-full h-full flex items-center justify-center font-mono text-xs uppercase tracking-widest opacity-50">
                    <?php echo empty($imageAlt) === false ? $imageAlt : 'image'; ?>
                </div>
<?php endif; ?>
            </div>
<?php if (empty($imageCaption) === false): ?>
            <figcaption class="text-sm opacity-80 mt-2"><?php echo $imageCaption; ?></figcaption>
<?php endif; ?>
        </figure>
<?php endforeach; ?>
    </div>
    </div>
</section>
