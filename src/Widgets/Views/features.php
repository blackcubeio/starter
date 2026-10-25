<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface[] $elastics
 * @var Yiisoft\Translator\TranslatorInterface|null $translator
 */

use App\Helpers\HeadingClass;
use Blackcube\Dcore\Helpers\Element;
use Blackcube\FileProvider\CacheFile;
use Yiisoft\Html\Html;

$count = count($elastics);
$articleClass = ($count <= 2) ? 'w-full md:w-1/2 px-3 py-3' : 'w-full md:w-1/2 lg:w-1/3 px-3 py-3';
$ctaLabel = $translator?->translate('Learn more', category: 'app-common') ?? 'Learn more';
?>
<section>
    <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-10 lg:py-14">
    <div class="flex flex-wrap -mx-3 -my-3">
<?php /** @var Blackcube\ActiveRecord\Elastic\ElasticInterface $featureElastic */ ?>
<?php foreach ($elastics as $index => $featureElastic):
    $featureIcon = $featureElastic->icon ?? '';
    $featureIconSvg = '';
    if (empty($featureIcon) === false) {
        $featureIconSvg = (string) CacheFile::from($featureIcon)->svg(['class' => 'w-5 h-5']);
    }
    $featureTitle = $featureElastic->title ?? '';
    $featureDescription = $featureElastic->description ?? '';
    $featureUrl = Element::extractUrl($featureElastic, ['route', 'url']) ?? '';
    $featureHasCta = empty($featureUrl) === false;
?>
        <?php echo Html::openTag('article', [
            'blackcube-fade-up' => true,
            'class' => $articleClass.' fade-up',
        ]); ?>
            <div class="border rule p-7 h-full flex flex-col gap-3 hover:border-primary-500 transition-colors">
                <div class="flex items-start gap-3 mb-2">
                    <span class="inline-flex items-center justify-center w-10 h-10 border rule font-mono text-xs shrink-0">
<?php if (empty($featureIconSvg) === false): ?>
                        <?php echo $featureIconSvg; ?>
<?php else: ?>
                        <?php echo str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT); ?>
<?php endif; ?>
                    </span>
<?php if (empty($featureTitle) === false): ?>
                    <?php echo Html::tag('h4', $featureTitle, ['class' => HeadingClass::for(4)])->encode(false); ?>
<?php endif; ?>
                </div>
<?php if (empty($featureDescription) === false): ?>
                <p class="text-sm leading-relaxed opacity-80"><?php echo $featureDescription; ?></p>
<?php endif; ?>
<?php if ($featureHasCta === true): ?>
                <?php echo Html::a(
                    Html::encode($ctaLabel).' '.Html::tag('span', '→', ['class' => 'arrow'])->render(),
                    $featureUrl,
                    ['class' => 'ulink self-end font-mono text-xs uppercase tracking-widest mt-2 text-primary-600 dark:text-primary-300'],
                )->encode(false); ?>
<?php endif; ?>
            </div>
        <?php echo Html::closeTag('article'); ?>
<?php endforeach; ?>
    </div>
    </div>
</section>
