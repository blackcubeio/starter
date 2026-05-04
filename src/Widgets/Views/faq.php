<?php
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */
?>
<details class="group rounded-lg border border-secondary-200 dark:border-secondary-700">
    <summary class="flex items-center justify-between px-5 py-4 cursor-pointer text-sm font-semibold text-secondary-900 dark:text-white hover:bg-secondary-100 dark:hover:bg-secondary-700 rounded-lg">
        <?php echo $elastic->title ?? ''; ?>
        <svg class="w-4 h-4 text-secondary-400 shrink-0 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
    </summary>
    <div class="px-5 pb-4 text-sm text-secondary-600 dark:text-secondary-400 leading-relaxed"><?php echo $elastic->description ?? ''; ?></div>
</details>
