<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

/**
 * @var Blackcube\Dcore\Entities\Content|Blackcube\Dcore\Entities\Tag $element
 * @var App\Widgets\AbstractWidget|null $hero
 * @var array<App\Widgets\AbstractWidget|App\Widgets\AbstractGroupWidget> $blocs
 */

use App\Widgets\Footer;
use App\Widgets\Header;
use App\Widgets\PrevNext;
use App\Widgets\Sidebar;
?>
<?php
$pageTitle = $element->title ?? '';
$pageTitle = trim(strip_tags((string) $pageTitle));
if ($pageTitle === '') {
    $pageTitle = $element->getName();
}
$sidebarHtml = Sidebar::widget()->element($element)->title($pageTitle)->render();
?>
<?php echo Header::widget()->element($element)->sidebar($sidebarHtml)->render(); ?>

<div class="mx-auto max-w-page w-full flex">

<?php if ($sidebarHtml !== ''): ?>
    <aside class="hidden md:block w-64 shrink-0 sticky top-32 h-screen overflow-y-auto border-r rule px-6 lg:px-10 py-10">
        <?php echo $sidebarHtml; ?>
    </aside>
<?php endif; ?>

    <main id="main" class="flex-1 min-w-0">
<?php if ($hero !== null): ?>
        <?php echo $hero->render(); ?>
<?php endif; ?>
<?php foreach ($blocs as $bloc): ?>
        <?php echo $bloc->render(); ?>
<?php endforeach; ?>
        <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-10 lg:py-14">
            <?php echo PrevNext::widget()->element($element)->render(); ?>
        </div>
    </main>

    <aside class="hidden xl:block w-56 shrink-0 sticky top-32 h-screen overflow-y-auto py-10 pr-6 lg:pr-10" blackcube-toc=""></aside>

</div>

<?php echo Footer::widget()->render(); ?>
