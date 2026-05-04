<?php
/**
 * @var Blackcube\Dcore\Entities\Menu[] $items
 * @var Yiisoft\Router\UrlGeneratorInterface $urlGenerator
 */

use Blackcube\Dcore\Helpers\Element;
use Yiisoft\Html\Html;
?>
<nav class="hidden md:flex items-center gap-1">
    <?php foreach ($items as $item):
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
            ['class' => 'px-3 py-2 text-sm font-medium text-secondary-600 dark:text-secondary-400 hover:text-secondary-900 dark:hover:text-white rounded-lg hover:bg-secondary-50 dark:hover:bg-secondary-800'],
        );
    endforeach; ?>
</nav>
