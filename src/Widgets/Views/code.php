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

use Yiisoft\Html\Html;

$language = $elastic->language ?? 'plaintext';
$filename = $elastic->filename ?? '';
$code = $elastic->code ?? '';
?>
<section>
    <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-10 lg:py-14">
    <figure blackcube-fade-up class="border rule overflow-hidden fade-up">
        <figcaption class="bg-secondary-100 dark:bg-secondary-800 border-b rule px-4 py-2 flex items-center justify-between font-mono text-xs">
            <span class="opacity-80"><?php echo $filename; ?></span>
            <span class="uppercase tracking-widest opacity-60"><?php echo $language; ?></span>
        </figcaption>
        <?php echo Html::openTag('pre', ['class' => 'text-sm leading-relaxed overflow-x-auto']); ?><?php echo Html::tag('code', $code, ['class' => 'hljs language-'.$language.' p-4 block']); ?><?php echo Html::closeTag('pre'); ?>
    </figure>
    </div>
</section>
