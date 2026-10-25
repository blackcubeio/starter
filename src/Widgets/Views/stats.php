<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface[] $elastics
 */

?>
<section class="bg-secondary-100 dark:bg-secondary-800">
    <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-12 lg:py-14">
    <dl class="grid grid-cols-2 md:grid-cols-3 gap-8 text-center">
<?php /** @var Blackcube\ActiveRecord\Elastic\ElasticInterface $statElastic */ ?>
<?php foreach ($elastics as $statElastic):
    $statTitle = $statElastic->title ?? '';
    $statDescription = $statElastic->description ?? '';
?>
        <div blackcube-fade-up class="fade-up">
<?php if (empty($statTitle) === false): ?>
            <dt class="title-accent font-bold text-3xl md:text-4xl tracking-tight leading-none"><?php echo $statTitle; ?></dt>
<?php endif; ?>
<?php if (empty($statDescription) === false): ?>
            <dd class="ml-0 font-mono text-xs uppercase tracking-widest mt-3 opacity-90"><?php echo $statDescription; ?></dd>
<?php endif; ?>
        </div>
<?php endforeach; ?>
    </dl>
    </div>
</section>
