<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */

$title = $elastic->title ?? '';
$description = $elastic->description ?? '';
?>
<section class="bg-secondary-100 dark:bg-secondary-800">
    <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-12 lg:py-14">
    <dl blackcube-fade-up class="max-w-md mx-auto text-center fade-up">
<?php if (empty($title) === false): ?>
        <dt class="title-accent font-bold text-5xl sm:text-6xl md:text-7xl lg:text-8xl tracking-tight leading-none"><?php echo $title; ?></dt>
<?php endif; ?>
<?php if (empty($description) === false): ?>
        <dd class="ml-0 font-mono text-xs uppercase tracking-widest mt-3 opacity-90"><?php echo $description; ?></dd>
<?php endif; ?>
    </dl>
    </div>
</section>
