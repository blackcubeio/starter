<?php
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */

use Blackcube\FileProvider\CacheFile;
use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$contentImageSrc = '';
if (isset($elastic->image) && !empty($elastic->image)) {
    $contentImageSrc = (string) CacheFile::from($elastic->image)->scale(1024);
}
$position = $elastic->position ?? 'left';
?>
<div class="p-4 rounded-xl bg-secondary-50 dark:bg-secondary-800/30">
    <div class="flex flex-col md:flex-row gap-6 items-start">
        <?php if ($contentImageSrc !== '' && $position === 'left'): ?>
            <div class="md:w-48 shrink-0 rounded-lg overflow-hidden order-first">
                <?php echo Html::img(
                    $contentImageSrc,
                    $elastic->alt ?? '',
                    [
                        'class' => 'w-full object-cover',
                    ]); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($elastic->description) && !empty($elastic->description)): ?>
        <div class="flex-1 text-secondary-700 dark:text-secondary-300 leading-relaxed">
            <?php echo Quill::cleanHtml($elastic->description); ?>
        </div>
        <?php endif; ?>
        <?php if ($contentImageSrc !== '' && $position === 'right'): ?>
            <div class="md:w-48 shrink-0 rounded-lg overflow-hidden">
                <?php echo Html::img(
                        $contentImageSrc,
                        $elastic->alt ?? '',
                        [
                                'class' => 'w-full object-cover',
                        ]); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
