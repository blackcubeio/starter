<?php
/**
 * index.php
 *
 * PHP Version 8.1
 *
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
$sidebar = Sidebar::widget()->element($element)->title($pageTitle);
?>
<?php echo Header::widget()->element($element)->sidebar($sidebar)->render(); ?>

<div class="mx-auto max-w-screen-2xl flex">

<?php if ($sidebar !== null): ?>
    <aside class="hidden md:block w-64 shrink-0 sticky top-16 h-nav overflow-y-auto border-r border-secondary-200 dark:border-secondary-700 p-4">
        <?php echo $sidebar->render(); ?>
    </aside>
<?php endif; ?>

    <main id="main" role="main" class="flex-1 min-w-0">
<?php if ($hero !== null): ?>
        <?php echo $hero->render(); ?>
<?php endif; ?>
<?php foreach ($blocs as $bloc): ?>
        <?php echo $bloc->render(); ?>
<?php endforeach; ?>
        <div class="mx-auto max-w-screen-xl px-6 py-8 md:py-14">
            <?php echo PrevNext::widget()->element($element)->render(); ?>
        </div>
    </main>

    <aside class="hidden xl:block w-56 shrink-0 sticky top-16 h-nav overflow-y-auto py-10 pl-8 pr-4" blackcube-toc="title: <?php echo $element->getLanguageId() === 'fr' ? 'Sur cette page' : 'On this page'; ?>"></aside>

</div>

<?php echo Footer::widget()->render(); ?>
