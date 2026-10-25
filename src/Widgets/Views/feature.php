<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 * @var Yiisoft\Translator\TranslatorInterface|null $translator
 */

use App\Helpers\HeadingClass;
use Blackcube\Dcore\Helpers\Element;
use Blackcube\FileProvider\CacheFile;
use Yiisoft\Html\Html;

$icon = $elastic->icon ?? '';
$iconSvg = '';
if (empty($icon) === false) {
    $iconSvg = (string) CacheFile::from($icon)->svg([
        'class' => 'w-5 h-5',
    ]);
}

$title = $elastic->title ?? '';
$description = $elastic->description ?? '';
$featureUrl = Element::extractUrl($elastic, ['route', 'url']) ?? '';

$hasCta = empty($featureUrl) === false;
?>
<section>
    <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-10 lg:py-14">
    <article blackcube-fade-up class="max-w-md border rule p-7 flex flex-col gap-3 fade-up">
        <div class="flex items-center gap-3 mb-2">
            <span class="inline-flex items-center justify-center w-10 h-10 border rule font-mono text-xs shrink-0">
<?php if (empty($iconSvg) === false): ?>
                <?php echo $iconSvg; ?>
<?php else: ?>
                ●
<?php endif; ?>
            </span>
<?php if (empty($title) === false): ?>
            <?php echo Html::tag('h4', $title, ['class' => HeadingClass::for(4)])->encode(false); ?>
<?php endif; ?>
        </div>
<?php if (empty($description) === false): ?>
        <p class="text-sm leading-relaxed opacity-80"><?php echo $description; ?></p>
<?php endif; ?>
<?php if ($hasCta === true): ?>
        <?php $ctaLabel = $translator?->translate('Learn more', category: 'app-common') ?? 'Learn more'; ?>
        <?php echo Html::a(
            Html::encode($ctaLabel).' '.Html::tag('span', '→', ['class' => 'arrow'])->render(),
            $featureUrl,
            ['class' => 'ulink self-end font-mono text-xs uppercase tracking-widest mt-2 text-primary-600 dark:text-primary-300'],
        )->encode(false); ?>
<?php endif; ?>
    </article>
    </div>
</section>
