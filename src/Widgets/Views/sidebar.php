<?php
/**
 * @var array{name: string, node: Blackcube\Dcore\Entities\Content, items: Blackcube\Dcore\Entities\Content[]}[] $groups
 */

use Blackcube\Dcore\Helpers\Element;
use Yiisoft\Html\Html;
?>
<nav class="space-y-6 text-sm">
    <?php foreach ($groups as $group): ?>
    <div>
        <?php
            $sectionNode = $group['node'];
            $sectionUrl = null;
            if ($sectionNode !== null && $sectionNode->getSlugId() !== null) {
                $sectionSlug = $sectionNode->getSlugQuery()->one();
                if ($sectionSlug !== null) {
                    $sectionLink = $sectionSlug->getLink();
                    $sectionUrl = $sectionLink->isTemplated()
                        ? '/' . ltrim($sectionSlug->getPath(), '/')
                        : $sectionLink->getHref();
                }
            }
            if ($sectionUrl !== null) {
                echo Html::a(Html::encode($group['name']), $sectionUrl, ['class' => 'block font-semibold text-primary-900 dark:text-white mb-2 hover:text-primary-700 dark:hover:text-primary-400']);
            } else {
                echo Html::tag('h3', Html::encode($group['name']), ['class' => 'font-semibold text-primary-900 dark:text-white mb-2']);
            }
        ?>
        <div class="space-y-0.5">
            <?php foreach ($group['items'] as $item):
                $slug = $item->getSlugQuery()->one();
                if ($slug === null) {
                    continue;
                }
                $link = $slug->getLink();
                $url = $link->isTemplated()
                    ? '/' . ltrim($slug->getPath(), '/')
                    : $link->getHref();

                echo Html::a(
                    Html::encode($item->getName()),
                    $url,
                    ['class' => 'block px-3 py-1.5 rounded-md text-secondary-600 dark:text-secondary-400 hover:bg-secondary-100 dark:hover:bg-secondary-800'],
                );
            endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
</nav>
