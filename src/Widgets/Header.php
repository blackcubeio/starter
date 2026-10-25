<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets;

use Blackcube\Dcore\Entities\Content;
use Blackcube\Dcore\Entities\Menu;
use Blackcube\Dcore\Entities\Tag;
use Blackcube\Dcore\Helpers\Element;
use Yiisoft\I18n\LocaleProvider;

/**
 * Site header: navigation menu of the current language and the page sidebar.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
class Header extends AbstractBaseWidget
{
    private Content|Tag|null $element = null;
    private ?string $sidebar = null;

    public function __construct(
        private readonly LocaleProvider $localeProvider,
    ) {
    }

    public function element(Content|Tag $element): self
    {
        $this->element = $element;
        return $this;
    }

    public function sidebar(?string $html): self
    {
        $this->sidebar = $html;
        return $this;
    }

    public function render(): string
    {
        $locale = $this->localeProvider->get()->asString();
        $homeUrl = $this->homeUrl($locale);
        $navItems = $this->buildNavItems($locale);
        $translations = $this->buildTranslations();

        return $this->renderView('header', [
            'homeUrl' => $homeUrl,
            'navItems' => $navItems,
            'translations' => $translations,
            'sidebar' => $this->sidebar,
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
                'name' => 'Header',
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

    /**
     * @return array{languageId: string, url: string}[]
     */
    private function buildTranslations(): array
    {
        $translations = [];
        if ($this->element === null) {
            return $translations;
        }

        $translationsQuery = $this->element->getTranslationsQuery()->with(['slug']);

        /** @var Content|Tag $translation */
        foreach ($translationsQuery->each() as $translation) {
            $translationSlug = $translation->slug;
            if ($translationSlug !== null) {
                $translations[] = [
                    'languageId' => $translation->getLanguageId(),
                    'url' => $translationSlug->getLink()->getHref(),
                ];
            }
        }

        return $translations;
    }
}
