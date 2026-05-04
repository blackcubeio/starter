<?php
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */
?>
<div class="p-8 rounded-xl bg-secondary-50 dark:bg-secondary-800/30">
    <div class="w-full aspect-video rounded-lg bg-secondary-200 dark:bg-secondary-700 flex items-center justify-center">
        <div class="text-center">
            <svg class="w-12 h-12 text-secondary-400 dark:text-secondary-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span class="text-sm font-mono text-secondary-400 dark:text-secondary-500"><?php echo $elastic->url ?? ''; ?></span>
        </div>
    </div>
    <?php if (isset($elastic->title) && !empty($elastic->title)): ?>
    <p class="mt-3 font-semibold text-secondary-900 dark:text-white text-sm"><?php echo $elastic->title; ?></p>
    <?php endif; ?>
    <?php if (isset($elastic->description) && !empty($elastic->description)): ?>
    <div class="mt-1 text-sm text-secondary-600 dark:text-secondary-400"><?php echo $elastic->description; ?></div>
    <?php endif; ?>
</div>
