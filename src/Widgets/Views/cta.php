<?php
/**
 * cta.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */

use App\Helpers\HeadingClass;
use App\Widgets\Svg;
use Blackcube\Dcore\Helpers\Element;
use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$level = HeadingClass::clamp($elastic->level);

$headingTag = 'h'.$level;
$headingClass = HeadingClass::for($level).' max-w-3xl mx-auto text-white dark:text-primary-900 mb-3';

$title = $elastic->title ?? '';
$description = $elastic->description ?? '';
$label = $elastic->label ?? '';
$ctaUrl = Element::extractUrl($elastic, ['route', 'url']) ?? '';

$hasCta = empty($ctaUrl) === false && empty($label) === false;
$descriptionClass = ($hasCta === true)
    ? 'rich text-primary-200 dark:text-primary-700 max-w-4xl mx-auto space-y-3 mb-8'
    : 'rich text-primary-200 dark:text-primary-700 max-w-4xl mx-auto space-y-3';

$arrowIconSvg = Svg::icon('arrow-right')->addClass('w-4 h-4')->render();
?>
<section class="mx-auto max-w-screen-xl px-6 py-4">
    <div blackcube-fade-up class="fade-up rounded-xl overflow-hidden border border-secondary-200 dark:border-secondary-700">
        <div class="bg-primary-700 dark:bg-primary-100 p-10 md:p-14 text-center">
<?php if (empty($title) === false): ?>
            <?php echo Html::tag($headingTag, $title, ['class' => $headingClass])->encode(false); ?>
<?php endif; ?>
<?php if (empty($description) === false): ?>
            <?php echo Html::tag('div', Quill::cleanHtml($description), ['class' => $descriptionClass])->encode(false); ?>
<?php endif; ?>
<?php if ($hasCta === true): ?>
            <?php echo Html::a(
                $label.$arrowIconSvg,
                $ctaUrl,
                ['class' => 'inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-primary-700 bg-white hover:bg-primary-50 dark:text-white dark:bg-primary-900 dark:hover:bg-primary-800 rounded-lg transition-colors'],
            )->encode(false); ?>
<?php endif; ?>
        </div>
    </div>
</section>
