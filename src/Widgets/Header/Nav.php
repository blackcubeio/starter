<?php

declare(strict_types=1);

namespace App\Widgets\Header;

use App\Widgets\AbstractBaseWidget;
use Blackcube\Dcore\Entities\Menu;
use RuntimeException;
use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Widget\Widget;

final class Nav extends AbstractBaseWidget
{
    public function __construct(
        private readonly LocaleProvider $localeProvider,
        private readonly UrlGeneratorInterface $urlGenerator,
    ) {
    }

    public function render(): string
    {
        $locale = $this->localeProvider->get()->asString();

        $root = Menu::query()
            ->roots()
            ->andWhere(['name' => 'Header', 'languageId' => $locale])
            ->one();

        if ($root === null) {
            return '';
        }

        $items = $root->relativeQuery()->children()->each();

        return $this->renderView('header/nav', [
            'items' => $items,
            'urlGenerator' => $this->urlGenerator,
        ]);
    }
}
