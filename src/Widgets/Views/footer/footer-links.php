<?php
/**
 * @var array{name: string, items: Blackcube\Dcore\Entities\Menu[]}[] $groups
 * @var Yiisoft\Router\UrlGeneratorInterface $urlGenerator
 */

use Blackcube\Dcore\Helpers\Element;
use Yiisoft\Html\Html;
?>
<div class="flex flex-wrap gap-10 md:gap-16 text-sm">
    <?php foreach ($groups as $group): ?>
    <div>
        <h4 class="font-semibold text-secondary-900 dark:text-white mb-3"><?php echo Html::encode($group['name']); ?></h4>
        <div class="space-y-2">
            <?php foreach ($group['items'] as $item):
                $route = $item->getRoute();
                if ($route === null || $route === '') {
                    continue;
                }

                $url = null;
                $element = Element::createFromRoute($route);
                if ($element !== null) {
                    $model = $element->getModel();
                    if ($model !== null) {
                        $slug = $model->getSlugQuery()->one();
                        if ($slug !== null) {
                            $link = $slug->getLink();
                            $url = $link->isTemplated()
                                ? '/' . ltrim($slug->getPath(), '/')
                                : $link->getHref();
                        }
                    }
                } else {
                    try {
                        $url = $urlGenerator->generate($route);
                    } catch (\Throwable) {
                    }
                }

                if ($url === null) {
                    continue;
                }

                echo Html::a(
                    Html::encode($item->getName()),
                    $url,
                    ['class' => 'block text-secondary-500 dark:text-secondary-400 hover:text-primary-700 dark:hover:text-primary-400'],
                );
            endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>
