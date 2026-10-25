<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

/**
 * @var string $homeUrl
 * @var array{name: string, url: string}[] $navItems
 */

use App\Widgets\Svg;
use Yiisoft\Html\Html;

$logoSvg = Svg::logo('blackcube')->addClass('h-5 w-5 text-secondary-900 dark:text-secondary-50')->render();

$brandHtml = $logoSvg.'<span class="opacity-70">© 2026. All Rights Reserved.</span>';
?>
<footer class="font-mono text-xs uppercase tracking-widest">
    <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-8 flex flex-col md:flex-row gap-6 md:items-center md:justify-between">
        <?php echo Html::a(
            $brandHtml,
            $homeUrl,
            ['class' => 'flex items-center gap-3 opacity-90'],
        )->encode(false); ?>
        <nav class="flex flex-wrap gap-x-7 gap-y-2">
<?php foreach ($navItems as $navItem): ?>
            <?php echo Html::a(
                $navItem['name'],
                $navItem['url'],
                ['class' => 'ulink'],
            ); ?>
<?php endforeach; ?>
        </nav>
    </div>
</footer>
