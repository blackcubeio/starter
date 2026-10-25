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

use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$title = $elastic->title ?? '';
$description = $elastic->description ?? '';
?>
<section>
    <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-10 lg:py-14">
    <div blackcube-fade-up class="flex flex-col border-t border-b rule fade-up">
        <details class="group">
            <summary class="cursor-pointer flex items-center justify-between gap-4 py-5 list-none">
                <span class="text-lg font-semibold tracking-tight"><?php echo $title; ?></span>
                <span class="font-mono text-xl group-open:rotate-45 transition-transform select-none">+</span>
            </summary>
<?php if (empty($description) === false): ?>
            <div class="rich pb-5 text-base leading-relaxed opacity-85 max-w-3xl space-y-3"><?php echo Quill::cleanHtml($description); ?></div>
<?php endif; ?>
        </details>
    </div>
    </div>
</section>
