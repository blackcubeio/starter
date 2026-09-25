<?php
/**
 * content.php
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
use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$position = $elastic->position ?? 'right';
if ($position !== 'left') {
    $position = 'right';
}

$description = $elastic->description ?? '';
$image = $elastic->image ?? '';
$alt = $elastic->alt ?? '';

$imageSrc = '';
if (empty($image) === false) {
    $imageSrc = (string) CacheFile::from($image)->scale(1024);
}

$hasImage = empty($imageSrc) === false;
$layoutClass = ($position === 'left')
    ? 'flex flex-col lg:flex-row-reverse gap-12 items-center'
    : 'flex flex-col lg:flex-row gap-12 items-center';
?>
<section class="mx-auto max-w-screen-xl px-6 py-4">
<?php if ($hasImage === true): ?>
    <?php echo Html::openTag('div', ['blackcube-fade-up' => true, 'class' => 'fade-up '.$layoutClass]); ?>
        <div class="flex-1">
<?php if (empty($description) === false): ?>
            <?php echo Html::tag('div', Quill::cleanHtml($description), ['class' => 'rich text-secondary-500 dark:text-secondary-400 leading-relaxed space-y-3'])->encode(false); ?>
<?php endif; ?>
        </div>
        <div class="flex-1">
            <?php echo Html::img($imageSrc, $alt, ['class' => 'w-full rounded-xl border border-secondary-200 dark:border-secondary-700 grayscale-25 contrast-105 dark:brightness-95']); ?>
        </div>
    <?php echo Html::closeTag('div'); ?>
<?php else: ?>
    <div blackcube-fade-up class="fade-up">
<?php if (empty($description) === false): ?>
        <?php echo Html::tag('div', Quill::cleanHtml($description), ['class' => 'rich max-w-4xl mx-auto text-secondary-500 dark:text-secondary-400 leading-relaxed space-y-3'])->encode(false); ?>
<?php endif; ?>
    </div>
<?php endif; ?>
</section>
