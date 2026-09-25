<?php

declare(strict_types=1);

/**
 * AbstractMenuNavigationWidget.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets;

use Blackcube\Dcore\Entities\Menu;
use Blackcube\Dcore\Helpers\Element;

/**
 * Base class for menu-driven navigation widgets (header, footer): builds the
 * nav items from the menu tree named after the concrete widget.
 */
abstract class AbstractMenuNavigationWidget extends AbstractBaseWidget
{

    abstract protected function getMenuName(): string;

    /**
     * @return array{name: string, url: string}[]
     */
    protected function buildNavItems(?string $locale = null): array
    {
        $navItems = [];
        if ($locale === null) {
            $locale = $this->localeProvider->get()->asString();
        }
        $root = Menu::query()
            ->roots()
            ->andWhere(['name' => $this->getMenuName(), 'languageId' => $locale])
            ->one();

        if ($root !== null) {
            $menuItemsQuery = $root->relativeQuery()->children();

            $routes = [];
            /** @var Menu $menuItem */
            foreach ($menuItemsQuery->each() as $menuItem) {
                $route = $menuItem->getRoute();
                if ($route !== null && empty($route) === false) {
                    $navItems[] = [
                        'name' => $menuItem->getName(),
                        'url' => null,
                        'route' => $route,
                    ];
                    $routes[] = $route;
                }
            }
            $urls = Element::getUrlsFromRoutes($routes);
            for ($i = 0; $i < count($navItems); $i++) {
                $url = $urls[$navItems[$i]['route']] ?? null;
                $navItems[$i]['url'] = $url;
            }
        }

        return $navItems;
    }
}
