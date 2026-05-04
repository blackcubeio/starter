<?php
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */

use Blackcube\Dcore\Helpers\Element;
use Blackcube\FileProvider\CacheFile;
use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$heroImageSrc = '';
if (isset($elastic->image) && !empty($elastic->image)) {
    $heroImageSrc = (string) CacheFile::from($elastic->image)->scale(1024);
}

$ctaUrl = Element::resolveLink($elastic, ['route', 'url']);
$secondaryCtaUrl = Element::resolveLink($elastic, ['secondaryRoute', 'secondaryUrl']);
?>
<div class="rounded-xl overflow-hidden relative">
    <div class="absolute inset-0 bg-secondary-300 dark:bg-secondary-600">
        <div class="absolute inset-0 flex items-center justify-center">
            <?php if ($heroImageSrc !== ''): ?>
                <?php echo Html::img(
                        $heroImageSrc,
                    $elastic->alt ?? 'Hero image',
                    [
                    'class' => 'w-full h-full object-cover',
                ]); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="absolute inset-0 bg-primary-900/75 dark:bg-primary-900/85"></div>
    <div class="relative z-10 px-8 py-20 text-center">
        <?php if (isset($elastic->overline) && !empty($elastic->overline)): ?>
        <p class="text-sm font-semibold text-primary-200 uppercase tracking-wider mb-4">
            <?php echo $elastic->overline; ?>
        </p>
        <?php endif; ?>
        <?php if (isset($elastic->title) && !empty($elastic->title)): ?>
        <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-6 max-w-2xl mx-auto">
            <?php echo $elastic->title; ?>
        </h1>
        <?php endif; ?>
        <?php if (isset($elastic->description) && !empty($elastic->description)): ?>
        <div class="text-lg text-primary-100 leading-relaxed max-w-xl mx-auto mb-8">
            <?php echo Quill::cleanHtml($elastic->description); ?>
        </div>
        <?php endif; ?>
        <?php if ($ctaUrl !== null || $secondaryCtaUrl !== null): ?>
        <div class="flex flex-wrap items-center justify-center gap-4">
            <?php if ($ctaUrl !== null && isset($elastic->label) && !empty($elastic->label)):
                $arrow = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>';
                echo Html::a(
                    Html::encode($elastic->label) . ' ' . $arrow,
                    $ctaUrl,
                    ['class' => 'inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-primary-900 bg-white hover:bg-primary-50 rounded-lg transition-colors'],
                )->encode(false);
            endif; ?>
            <?php if ($secondaryCtaUrl !== null && isset($elastic->secondaryLabel) && !empty($elastic->secondaryLabel)):
                echo Html::a(
                    Html::encode($elastic->secondaryLabel),
                    $secondaryCtaUrl,
                    ['class' => 'inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white border border-white/30 hover:bg-white/10 rounded-lg transition-colors'],
                );
            endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
