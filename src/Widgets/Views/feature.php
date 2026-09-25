<?php
/**
 * feature.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 * @var Yiisoft\Translator\TranslatorInterface|null $translator
 */

use App\Widgets\Svg;
use Blackcube\Dcore\Helpers\Element;
use Blackcube\FileProvider\CacheFile;
use Yiisoft\Html\Html;

$icon = $elastic->icon ?? '';
$iconSvg = '';
if (empty($icon) === false) {
    $iconSvg = (string) CacheFile::from($icon)->svg(['class' => 'w-5 h-5']);
}

$title = $elastic->title ?? '';
$description = $elastic->description ?? '';
$featureUrl = Element::extractUrl($elastic, ['route', 'url']) ?? '';

$hasCta = empty($featureUrl) === false;
$arrowIconSvg = Svg::icon('arrow-right')->addClass('w-4 h-4')->render();
$ctaLabel = $translator?->translate('Learn more', category: 'app-common') ?? 'Learn more';
?>
<section class="mx-auto max-w-screen-xl px-6 py-4">
    <div blackcube-fade-up class="fade-up max-w-md mx-auto p-6 rounded-xl border border-secondary-200 dark:border-secondary-700 bg-secondary-50 dark:bg-primary-800/30 hover:border-primary-300 dark:hover:border-primary-600 transition-colors flex flex-col">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-lg bg-primary-700 dark:bg-primary-100 flex items-center justify-center shrink-0 text-white dark:text-primary-900">
<?php if (empty($iconSvg) === false): ?>
                <?php echo $iconSvg; ?>
<?php else: ?>
                ●
<?php endif; ?>
            </div>
<?php if (empty($title) === false): ?>
            <?php echo Html::tag('h3', $title, ['class' => 'text-lg font-semibold text-primary-900 dark:text-white'])->encode(false); ?>
<?php endif; ?>
        </div>
<?php if (empty($description) === false): ?>
        <?php echo Html::tag('p', $description, ['class' => 'text-secondary-600 dark:text-secondary-400 text-sm leading-relaxed'])->encode(false); ?>
<?php endif; ?>
<?php if ($hasCta === true): ?>
        <?php echo Html::a(
            Html::encode($ctaLabel).' '.$arrowIconSvg,
            $featureUrl,
            ['class' => 'inline-flex items-center gap-1 self-end mt-2 -mr-3 px-3 py-2 text-sm font-medium text-primary-700 dark:text-primary-300 hover:text-primary-900 dark:hover:text-white rounded-lg hover:bg-secondary-100 dark:hover:bg-secondary-800 transition-colors'],
        )->encode(false); ?>
<?php endif; ?>
    </div>
</section>
