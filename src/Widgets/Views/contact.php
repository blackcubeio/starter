<?php
/**
 * @var \Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */

use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;
?>
<div class="p-8 rounded-xl bg-secondary-50 dark:bg-secondary-800/30">
    <?php if(isset($elastic->description) && !empty($elastic->description)): ?>
    <div class="text-secondary-700 dark:text-secondary-300 leading-relaxed mb-6">
        <?php echo Quill::cleanHtml($elastic->description); ?>
    </div>
    <?php endif; ?>
    <div class="space-y-4 max-w-md">
        <div class="h-10 rounded-lg border border-secondary-300 dark:border-secondary-600 bg-white dark:bg-secondary-800 flex items-center px-3">
            <span class="text-sm text-secondary-400 font-mono">
                formulaire de contact
            </span>
        </div>
        <div class="h-24 rounded-lg border border-secondary-300 dark:border-secondary-600 bg-white dark:bg-secondary-800 flex items-start p-3">
            <span class="text-sm text-secondary-400 font-mono">
                message
            </span>
        </div>
        <button class="px-5 py-2.5 text-sm font-semibold text-white bg-primary-700 dark:bg-primary-600 rounded-lg">
            Envoyer
        </button>
    </div>
    <?php if((isset($elastic->successTitle) && !empty($elastic->successTitle)) || ((isset($elastic->successDescription) && !empty($elastic->successDescription)))): ?>
    <div class="mt-6 p-4 rounded-lg border border-dashed border-success-300 dark:border-success-700 bg-success-50 dark:bg-success-900/20">
        <?php if(isset($elastic->successTitle) && !empty($elastic->successTitle)): ?>
        <p class="font-semibold text-success-800 dark:text-success-300 text-sm">
            <?php echo $elastic->successTitle; ?>
        </p>
        <?php endif; ?>
        <?php if(isset($elastic->successDescription) && !empty($elastic->successDescription)): ?>
        <div class="text-success-700 dark:text-success-400 text-sm mt-1">
            <?php echo Quill::cleanHtml($elastic->successDescription); ?>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>
