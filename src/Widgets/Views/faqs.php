<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface[] $elastics
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface|null $header
 * @var string $locale
 */

use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$headingTag = 'h2';
$headingClass = 'text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight leading-none';
$headingTitle = '';
$headingDescription = '';

if ($header !== null) {
    $headingTitle = $header->title ?? '';
    $headingDescription = $header->description ?? '';
    $level = (int) ($header->level ?? 2);
    if ($level < 2) {
        $level = 2;
    }
    if ($level > 6) {
        $level = 6;
    }
    $headingTag = 'h'.$level;
    $headingClass = match ($level) {
        2 => 'text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight leading-none',
        3 => 'text-2xl md:text-3xl font-semibold tracking-tight',
        4 => 'text-xl font-semibold tracking-tight',
        5 => 'text-lg font-semibold tracking-tight',
        6 => 'text-base font-semibold tracking-tight',
        default => 'text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight leading-none',
    };
}

if (empty($headingTitle) === true) {
    $headingTitle = $locale === 'fr' ? 'Questions fréquentes' : 'Frequently asked questions';
}
?>
<section>
    <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-10 lg:py-14">
    <div blackcube-fade-up class="flex flex-col gap-8 fade-up">
    <div class="flex flex-col gap-3 max-w-3xl">
        <?php echo Html::openTag($headingTag, ['class' => $headingClass]); ?>
            <?php echo $headingTitle; ?>
        <?php echo Html::closeTag($headingTag); ?>
<?php if (empty($headingDescription) === false): ?>
        <div class="rich text-base leading-relaxed opacity-85 mt-2 max-w-2xl space-y-3">
            <?php echo Quill::cleanHtml($headingDescription); ?>
        </div>
<?php endif; ?>
    </div>
    <div class="flex flex-col border-t rule">
<?php /** @var Blackcube\ActiveRecord\Elastic\ElasticInterface $faqElastic */ ?>
<?php foreach ($elastics as $faqElastic):
    $faqTitle = $faqElastic->title ?? '';
    $faqDescription = $faqElastic->description ?? '';
?>
        <details class="border-b rule group">
            <summary class="cursor-pointer flex items-center justify-between gap-4 py-5 list-none">
                <span class="text-lg font-semibold tracking-tight"><?php echo $faqTitle; ?></span>
                <span class="font-mono text-xl group-open:rotate-45 transition-transform select-none">+</span>
            </summary>
<?php if (empty($faqDescription) === false): ?>
            <div class="rich pb-5 text-base leading-relaxed opacity-85 max-w-3xl space-y-3"><?php echo Quill::cleanHtml($faqDescription); ?></div>
<?php endif; ?>
        </details>
<?php endforeach; ?>
    </div>
    </div>
    </div>
</section>
