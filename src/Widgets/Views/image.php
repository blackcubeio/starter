<?php
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */

use Blackcube\Dcore\Helpers\Element;
use Blackcube\FileProvider\CacheFile;
use Yiisoft\Html\Html;

$imageSrc = '';
if (isset($elastic->image) && !empty($elastic->image)) {
    $imageSrc = (string) CacheFile::from($elastic->image)->scale(1024);
}

$imageUrl = Element::resolveLink($elastic, ['route', 'url']);
?>
<div class="p-8 rounded-xl bg-secondary-50 dark:bg-secondary-800/30">
    <figure>
        <?php if ($imageSrc !== ''): ?>
        <?php echo Html::img(
                $imageSrc,
                $elastic->alt ?? '',
                [
                        'class' => 'w-full object-cover rounded-lg',
                ]); ?>
        <?php else: ?>
        <div class="w-full aspect-video rounded-lg bg-secondary-200 dark:bg-secondary-700 flex items-center justify-center">
            <span class="text-sm text-secondary-400 dark:text-secondary-500"><?php echo $elastic->alt ?? 'Image'; ?></span>
        </div>
        <?php endif; ?>
        <?php if (isset($elastic->description) && !empty($elastic->description)): ?>
        <figcaption class="mt-3 text-sm text-secondary-500 dark:text-secondary-400">
            <?php echo $elastic->description; ?>
        </figcaption>
        <?php endif; ?>
        <?php if ($imageUrl !== null && isset($elastic->label) && !empty($elastic->label)):
            $arrow = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>';
            echo Html::a(
                Html::encode($elastic->label) . ' ' . $arrow,
                $imageUrl,
                ['class' => 'mt-3 inline-flex items-center gap-1 text-sm font-medium text-primary-700 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300'],
            )->encode(false);
        endif; ?>
    </figure>
</div>
