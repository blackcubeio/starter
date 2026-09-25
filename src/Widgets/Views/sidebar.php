<?php
/**
 * sidebar.php
 *
 * PHP Version 8.1
 *
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
<nav class="space-y-6 text-sm">
<?php if (empty($title) === false): ?>
    <?php echo Html::tag('h2', Html::encode($title), ['class' => 'text-base font-bold text-primary-900 dark:text-white']); ?>
<?php endif; ?>
    <?php foreach ($groups as $group): ?>
    <div>
        <?php
            $sectionNode = $group['node'];
            $sectionUrl = null;
            if ($sectionNode !== null && $sectionNode->getSlugId() !== null) {
                $sectionSlug = $sectionNode->getSlugQuery()->one();
                if ($sectionSlug !== null) {
                    $sectionUrl = $sectionSlug->getLink()->getHref();
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
                if ($slug !== null):
                    $url = $slug->getLink()->getHref();

                    echo Html::a(
                        Html::encode($item->getName()),
                        $url,
                        ['class' => 'block px-3 py-1.5 rounded-md text-secondary-600 dark:text-secondary-400 hover:bg-secondary-100 dark:hover:bg-secondary-800'],
                    );
                endif;
            endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
</nav>
