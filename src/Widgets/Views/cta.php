<?php
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */

use Blackcube\Dcore\Helpers\Element;
use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$ctaUrl = Element::resolveLink($elastic, ['route', 'url']);
?>
<div class="rounded-xl overflow-hidden border border-secondary-200 dark:border-secondary-700">
    <div class="bg-primary-700 dark:bg-primary-800 p-8 text-center">
        <?php if (isset($elastic->title) && !empty($elastic->title)): ?>
        <h2 class="text-xl font-bold text-white mb-2">
            <?php echo $elastic->title; ?>
        </h2>
        <?php endif; ?>
        <?php if (isset($elastic->description) && !empty($elastic->description)): ?>
        <div class="text-primary-200 text-sm mb-6 max-w-md mx-auto">
            <?php echo Quill::cleanHtml($elastic->description); ?>
        </div>
        <?php endif; ?>
        <?php if ($ctaUrl !== null && isset($elastic->label) && !empty($elastic->label)):
            $arrow = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>';
            echo Html::a(
                Html::encode($elastic->label) . ' ' . $arrow,
                $ctaUrl,
                ['class' => 'inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-primary-700 bg-white hover:bg-primary-50 rounded-lg transition-colors'],
            )->encode(false);
        endif; ?>
    </div>
</div>
