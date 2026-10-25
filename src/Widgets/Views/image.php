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
use Yiisoft\Html\Html;

$image = $elastic->image ?? '';
$imageSrc = '';
if (empty($image) === false) {
    $imageSrc = (string) CacheFile::from($image)->scale(1600);
}

$alt = $elastic->alt ?? '';
$description = $elastic->description ?? '';
?>
<section>
    <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-10 lg:py-14">
    <figure blackcube-fade-up class="max-w-3xl fade-up">
        <div class="aspect-video overflow-hidden border rule">
<?php if (empty($imageSrc) === false): ?>
            <?php echo Html::a(
                Html::img($imageSrc, $alt, ['class' => 'w-full h-full object-cover grayscale-85 contrast-105 dark:contrast-95 dark:brightness-85'])->render(),
                $imageSrc,
                [
                    'target' => '_blank',
                    'rel' => 'noopener',
                ],
            )->encode(false); ?>
<?php else: ?>
            <div class="w-full h-full flex items-center justify-center font-mono text-xs uppercase tracking-widest opacity-50">
                <?php echo empty($alt) === false ? $alt : 'image'; ?>
            </div>
<?php endif; ?>
        </div>
<?php if (empty($description) === false): ?>
        <figcaption class="mt-3 text-sm opacity-80"><?php echo $description; ?></figcaption>
<?php endif; ?>
    </figure>
    </div>
</section>
