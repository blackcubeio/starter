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

$url = $elastic->url ?? '';
$title = $elastic->title ?? '';
$description = $elastic->description ?? '';

$mediaType = 'unknown';
$embedUrl = $url;
$embedHeight = null;

if (empty($url) === false) {
    if (preg_match('#(?:youtube\.com/watch\?v=|youtu\.be/|youtube\.com/embed/)([A-Za-z0-9_-]+)#', $url, $matches) === 1) {
        $mediaType = 'youtube';
        $embedUrl = 'https://www.youtube.com/embed/'.$matches[1];
    } elseif (preg_match('#(?:vimeo\.com/(?:video/)?|player\.vimeo\.com/video/)(\d+)#', $url, $matches) === 1) {
        $mediaType = 'vimeo';
        $embedUrl = 'https://player.vimeo.com/video/'.$matches[1];
    } elseif (str_contains($url, 'open.spotify.com') === true) {
        $mediaType = 'spotify';
        $embedUrl = str_replace('open.spotify.com/', 'open.spotify.com/embed/', $url);
        $embedHeight = 152;
    } elseif (str_contains($url, 'soundcloud.com') === true) {
        $mediaType = 'soundcloud';
        $embedUrl = 'https://w.soundcloud.com/player/?url='.urlencode($url).'&color=%231a66b3&auto_play=false';
        $embedHeight = 166;
    }
}

$frameClass = $embedHeight === null
    ? 'aspect-video border rule overflow-hidden'
    : 'border rule overflow-hidden';
$frameStyle = $embedHeight === null ? null : 'height: '.$embedHeight.'px';
?>
<section>
    <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-10 lg:py-14">
    <figure blackcube-fade-up class="max-w-3xl fade-up">
<?php if (empty($url) === false): ?>
        <?php echo Html::openTag('div', array_filter([
            'class' => $frameClass,
            'style' => $frameStyle,
        ])); ?>
            <iframe
                class="w-full h-full"
                src="<?php echo Html::encode($embedUrl); ?>"
                title="<?php echo Html::encode(empty($title) === false ? $title : $mediaType); ?>"
                frameborder="0"
                loading="lazy"
                allowfullscreen
            ></iframe>
        <?php echo Html::closeTag('div'); ?>
<?php endif; ?>
<?php if (empty($title) === false || empty($description) === false): ?>
        <figcaption class="mt-3 flex flex-col gap-1">
<?php if (empty($title) === false): ?>
            <span class="text-base font-semibold tracking-tight"><?php echo $title; ?></span>
<?php endif; ?>
<?php if (empty($description) === false): ?>
            <span class="rich text-sm opacity-80"><?php echo Quill::cleanHtml($description); ?></span>
<?php endif; ?>
        </figcaption>
<?php endif; ?>
    </figure>
    </div>
</section>
