<?php
/**
 * section.php
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
use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$level = HeadingClass::clamp($elastic->level);

$headingTag = 'h'.$level;
$headingClass = HeadingClass::for($level).' text-center max-w-3xl mx-auto text-primary-900 dark:text-white mb-4';

$title = $elastic->title ?? '';
$description = $elastic->description ?? '';
?>
<section class="mx-auto max-w-screen-xl px-6 py-4">
    <div blackcube-fade-up class="fade-up">
<?php if (empty($title) === false): ?>
        <?php echo Html::tag($headingTag, $title, ['class' => $headingClass])->encode(false); ?>
<?php endif; ?>
<?php if (empty($description) === false): ?>
        <?php echo Html::tag('div', Quill::cleanHtml($description), ['class' => 'rich max-w-4xl mx-auto text-secondary-500 dark:text-secondary-400 leading-relaxed space-y-3'])->encode(false); ?>
<?php endif; ?>
    </div>
</section>
