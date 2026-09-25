<?php
/**
 * media.php
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

use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$url = $elastic->url ?? '';
$title = $elastic->title ?? '';
$description = $elastic->description ?? '';

$embedUrl = '';
$embedHeight = null;
if (empty($url) === false) {
    if (preg_match('#(?:youtube\.com/watch\?v=|youtu\.be/|youtube\.com/embed/)([A-Za-z0-9_-]+)#', $url, $matches) === 1) {
        $embedUrl = 'https://www.youtube.com/embed/'.$matches[1];
    } elseif (preg_match('#(?:vimeo\.com/(?:video/)?|player\.vimeo\.com/video/)(\d+)#', $url, $matches) === 1) {
        $embedUrl = 'https://player.vimeo.com/video/'.$matches[1];
    } elseif (str_contains($url, 'open.spotify.com') === true) {
        $embedUrl = str_replace('open.spotify.com/', 'open.spotify.com/embed/', $url);
        $embedHeight = 152;
    } elseif (str_contains($url, 'soundcloud.com') === true) {
        $embedUrl = 'https://w.soundcloud.com/player/?url='.urlencode($url).'&auto_play=false';
        $embedHeight = 166;
    }
}

$frameClass = ($embedHeight === null)
    ? 'w-full aspect-video rounded-xl overflow-hidden border border-secondary-200 dark:border-secondary-700'
    : 'w-full rounded-xl overflow-hidden border border-secondary-200 dark:border-secondary-700';
$frameStyle = ($embedHeight === null) ? null : 'height: '.$embedHeight.'px';
?>
<section class="mx-auto max-w-screen-xl px-6 py-4">
    <div blackcube-fade-up class="fade-up max-w-3xl mx-auto">
<?php if (empty($embedUrl) === false): ?>
        <?php echo Html::openTag('div', array_filter([
            'class' => $frameClass,
            'style' => $frameStyle,
        ])); ?>
            <?php echo Html::tag('iframe', '', [
                'src' => $embedUrl,
                'class' => 'w-full h-full',
                'frameborder' => '0',
                'allow' => 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture',
                'allowfullscreen' => true,
                'loading' => 'lazy',
                'title' => empty($title) === false ? $title : 'media',
            ])->encode(false); ?>
        <?php echo Html::closeTag('div'); ?>
<?php endif; ?>
<?php if (empty($title) === false): ?>
        <?php echo Html::tag('p', $title, ['class' => 'mt-3 font-semibold text-secondary-900 dark:text-white text-sm'])->encode(false); ?>
<?php endif; ?>
<?php if (empty($description) === false): ?>
        <?php echo Html::tag('div', Quill::cleanHtml($description), ['class' => 'rich mt-1 text-sm text-secondary-600 dark:text-secondary-400 space-y-2'])->encode(false); ?>
<?php endif; ?>
    </div>
</section>
