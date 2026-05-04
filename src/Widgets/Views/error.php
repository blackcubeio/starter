<?php
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 * @var Throwable $exception
 */

use Blackcube\Ssr\Helpers\Quill;

?>
Code : <?php echo $exception?->getCode(); ?><br>
<div class="p-4 rounded-xl bg-secondary-50 dark:bg-secondary-800/30">
    <div class="flex flex-col md:flex-row gap-6 items-start">
        <?php if (isset($elastic->description) && !empty($elastic->description)): ?>
            <div class="flex-1 text-secondary-700 dark:text-secondary-300 leading-relaxed">
                <?php echo Quill::cleanHtml($elastic->description); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
