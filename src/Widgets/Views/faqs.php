<?php
/**
 * faqs.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface[] $elastics
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface|null $header
 * @var string $locale
 */

use App\Helpers\HeadingClass;
use App\Widgets\Svg;
use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$chevronIconSvg = Svg::icon('chevron-down')->addClass('w-4 h-4 text-secondary-400 shrink-0 transition-transform group-open:rotate-180')->render();

$headerTitle = '';
$headerLevel = 2;
if ($header !== null) {
    $headerTitle = $header->title ?? '';
    $headerLevel = HeadingClass::clamp($header->level);
}
if (empty($headerTitle) === true) {
    $headerTitle = $locale === 'fr' ? 'Questions fréquentes' : 'Frequently asked questions';
}
$headerTag = 'h'.$headerLevel;
?>
<section class="mx-auto max-w-screen-xl px-6 py-4">
    <div blackcube-fade-up class="fade-up max-w-3xl mx-auto">
        <?php echo Html::tag($headerTag, $headerTitle, ['class' => 'text-2xl md:text-3xl font-bold text-primary-900 dark:text-white tracking-tight mb-6'])->encode(false); ?>
        <div class="space-y-3">
<?php /** @var Blackcube\ActiveRecord\Elastic\ElasticInterface $faqElastic */ ?>
<?php foreach ($elastics as $faqElastic):
    $faqTitle = $faqElastic->title ?? '';
    $faqDescription = $faqElastic->description ?? '';
    if (empty($faqTitle) === false):
?>
            <details class="group rounded-lg border border-secondary-200 dark:border-secondary-700 bg-secondary-50 dark:bg-primary-800/30">
                <summary class="flex items-center justify-between px-5 py-4 cursor-pointer text-sm font-semibold text-secondary-900 dark:text-white hover:bg-secondary-100 dark:hover:bg-primary-700/30 rounded-lg">
                    <span><?php echo $faqTitle; ?></span>
                    <?php echo $chevronIconSvg; ?>
                </summary>
<?php if (empty($faqDescription) === false): ?>
                <div class="rich px-5 pb-4 text-sm text-secondary-600 dark:text-secondary-400 leading-relaxed space-y-3"><?php echo Quill::cleanHtml($faqDescription); ?></div>
<?php endif; ?>
            </details>
<?php endif; ?>
<?php endforeach; ?>
        </div>
    </div>
</section>
