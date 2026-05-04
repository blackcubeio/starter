<?php
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */

use Blackcube\Dcore\Helpers\Element;
use Blackcube\FileProvider\CacheFile;
use Yiisoft\Html\Html;

$iconSvg = '';
if (isset($elastic->icon) && !empty($elastic->icon)) {
    $iconSvg = CacheFile::from($elastic->icon)->svg([
        'class' => 'w-5 h-5 text-primary-700 dark:text-primary-400',
    ]);
}

$featureUrl = Element::resolveLink($elastic, ['route', 'url']);
?>
<?php echo Html::openTag($featureUrl !== null ? 'a' : 'div', array_filter([
    'class' => 'block p-6 rounded-xl border border-secondary-200 dark:border-secondary-700 hover:border-primary-300 dark:hover:border-primary-600 transition-colors',
    'href' => $featureUrl,
])); ?>
    <?php if ($iconSvg !== ''): ?>
    <div class="w-10 h-10 rounded-lg bg-primary-50 dark:bg-primary-900/30 flex items-center justify-center mb-4">
        <?php echo $iconSvg; ?>
    </div>
    <?php endif; ?>
    <?php if (isset($elastic->title) && !empty($elastic->title)): ?>
    <h3 class="text-lg font-semibold text-primary-900 dark:text-white mb-2"><?php echo Html::encode($elastic->title); ?></h3>
    <?php endif; ?>
    <?php if (isset($elastic->description) && !empty($elastic->description)): ?>
    <p class="text-secondary-600 dark:text-secondary-400 text-sm leading-relaxed mb-3"><?php echo Html::encode($elastic->description); ?></p>
    <?php endif; ?>
    <?php if ($featureUrl !== null): ?>
    <span class="inline-flex items-center gap-1 text-sm font-medium text-primary-700 dark:text-primary-400">
        <?php echo $locale === 'fr' ? 'En savoir plus' : 'Learn more'; ?>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
    </span>
    <?php endif; ?>
<?php echo Html::closeTag($featureUrl !== null ? 'a' : 'div'); ?>
