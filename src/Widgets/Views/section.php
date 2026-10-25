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
?>
<section>
    <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-10 lg:py-14">
    <div blackcube-fade-up class="flex flex-col gap-3 w-full lg:w-2/3 fade-up">
<?php if (empty($title) === false): ?>
    <?php echo Html::openTag($headingTag, ['class' => $headingClass]); ?>
        <?php echo $title; ?>
    <?php echo Html::closeTag($headingTag); ?>
<?php endif; ?>
<?php if (empty($description) === false): ?>
    <div class="rich text-base leading-relaxed opacity-85 mt-2 space-y-3">
        <?php echo Quill::cleanHtml($description); ?>
    </div>
<?php endif; ?>
    </div>
    </div>
</section>
