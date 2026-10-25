<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets;

use Blackcube\Dcore\Entities\Menu;
use Blackcube\Dcore\Helpers\Element;
use Yiisoft\I18n\LocaleProvider;

/**
 * Site footer: home link and navigation menu of the current language.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
class Footer extends AbstractBaseWidget
{
    public function __construct(
        private readonly LocaleProvider $localeProvider,
    ) {
    }

    public function render(): string
    {
        $locale = $this->localeProvider->get()->asString();
        $homeUrl = $this->homeUrl($locale);
        $navItems = $this->buildNavItems($locale);

        return $this->renderView('footer', [
            'homeUrl' => $homeUrl,
            'navItems' => $navItems,
        ]);
    }

    /**
     * @return array{name: string, url: string}[]
     */
    private function buildNavItems(string $locale): array
    {
        $navItems = [];
        $root = Menu::query()
            ->roots()
            ->andWhere([
                'name' => 'Footer',
                'languageId' => $locale,
            ])
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
            for($i=0; $i<count($navItems); $i++) {
                $url = $urls[$navItems[$i]['route']] ?? null;
                $navItems[$i]['url'] = $url;
            }
        }

        return $navItems;
    }
}
