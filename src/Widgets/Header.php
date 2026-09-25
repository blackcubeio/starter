<?php

declare(strict_types=1);

/**
 * Header.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets;

use Blackcube\Dcore\Entities\Content;
use Blackcube\Dcore\Entities\Tag;

class Header extends AbstractMenuNavigationWidget
{
    private Content|Tag|null $element = null;
    private ?Sidebar $sidebar = null;

    public function element(Content|Tag $element): self
    {
        $this->element = $element;
        return $this;
    }

    public function sidebar(?Sidebar $sidebar): self
    {
        $this->sidebar = $sidebar;
        return $this;
    }

    protected function getMenuName(): string
    {
        return 'Header';
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
     * @return array{languageId: string, url: string}[]
     */
    private function buildTranslations(): array
    {
        $translations = [];
        if ($this->element !== null) {
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
        }

        return $translations;
    }
}
