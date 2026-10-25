<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

/**
 * @var string|null $title
 * @var array{name: string, node: Blackcube\Dcore\Entities\Content, items: Blackcube\Dcore\Entities\Content[]}[] $groups
 */

use Blackcube\Dcore\Helpers\Element;
use Yiisoft\Html\Html;
?>
<nav class="space-y-6 text-lg">
<?php if (empty($title) === false): ?>
    <?php echo Html::tag('h2', Html::encode($title), ['class' => 'text-xl font-bold']); ?>
<?php endif; ?>
    <?php foreach ($groups as $group): ?>
    <div>
        <?php
            $sectionNode = $group['node'];
            $sectionUrl = null;
            if ($sectionNode !== null && $sectionNode->getSlugId() !== null) {
                $sectionSlug = $sectionNode->getSlugQuery()->one();
                if ($sectionSlug !== null) {
                    $sectionLink = $sectionSlug->getLink();
                    $sectionUrl = $sectionLink->getHref();
                }
            }
            if ($sectionUrl !== null) {
                echo Html::a(Html::encode($group['name']), $sectionUrl, ['class' => 'block font-semibold mb-2 hover:opacity-80']);
            } else {
                echo Html::tag('h3', Html::encode($group['name']), ['class' => 'font-semibold mb-2']);
            }
        ?>
        <div class="space-y-0.5">
            <?php foreach ($group['items'] as $item):
                $slug = $item->getSlugQuery()->one();
                if ($slug === null) {
                    continue;
                }
                $link = $slug->getLink();
                $url = $link->getHref();

                echo Html::a(
                    Html::encode($item->getName()),
                    $url,
                    ['class' => 'block px-3 py-1.5 rounded-md opacity-85 hover:opacity-100 hover:bg-current/10'],
                );
            endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
</nav>
