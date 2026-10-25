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

use App\Helpers\HeadingClass;
use Blackcube\Dcore\Helpers\Element;
use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$level = (int) ($elastic->level ?? 2);
if ($level < 2) {
    $level = 2;
}
if ($level > 6) {
    $level = 6;
}

$headingTag = 'h'.$level;
$headingClass = HeadingClass::for($level);

$title = $elastic->title ?? '';
$description = $elastic->description ?? '';
$label = $elastic->label ?? '';
$ctaUrl = Element::extractUrl($elastic, ['route', 'url']) ?? '';

$hasCta = empty($ctaUrl) === false && empty($label) === false;
$textClass = ($hasCta === true) ? 'w-full lg:w-1/2' : 'w-full lg:w-2/3';
$ctaWrapperClass = 'w-full lg:w-1/2 flex flex-col items-center gap-4 font-mono text-sm';

$sectionClass = 'theme-inverted bg-secondary-900 text-secondary-50 dark:bg-secondary-50 dark:text-secondary-900';
$containerClass = 'mx-auto max-w-page w-full px-6 lg:px-10 py-10 lg:py-16 flex flex-col lg:flex-row gap-10 lg:gap-16 items-center';
?>
<?php echo Html::openTag('section', ['class' => $sectionClass]); ?>
    <?php echo Html::openTag('div', [
        'blackcube-fade-up' => true,
        'class' => $containerClass.' fade-up',
    ]); ?>
        <?php echo Html::openTag('div', ['class' => $textClass]); ?>
<?php if (empty($title) === false): ?>
            <?php echo Html::openTag($headingTag, ['class' => $headingClass]); ?><?php echo $title; ?><?php echo Html::closeTag($headingTag); ?>
<?php endif; ?>
<?php if (empty($description) === false): ?>
            <div class="rich mt-8 max-w-2xl text-lg leading-relaxed opacity-90 space-y-3"><?php echo Quill::cleanHtml($description); ?></div>
<?php endif; ?>
        <?php echo Html::closeTag('div'); ?>
<?php if ($hasCta === true): ?>
        <?php echo Html::openTag('div', ['class' => $ctaWrapperClass]); ?>
            <?php echo Html::a(
                Html::encode($label).' <span class="arrow">→</span>',
                $ctaUrl,
                ['class' => 'cta inline-flex px-8 py-4 bg-primary-500 text-secondary-50 hover:bg-primary-400 transition-colors uppercase tracking-widest text-sm'],
            )->encode(false); ?>
        <?php echo Html::closeTag('div'); ?>
<?php endif; ?>
    <?php echo Html::closeTag('div'); ?>
<?php echo Html::closeTag('section'); ?>
