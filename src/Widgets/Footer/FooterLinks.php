<?php

declare(strict_types=1);

namespace App\Widgets\Footer;

use App\Widgets\AbstractBaseWidget;
use Blackcube\Dcore\Entities\Menu;
use RuntimeException;
use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Widget\Widget;

final class FooterLinks extends AbstractBaseWidget
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
            ->andWhere(['name' => 'Footer', 'languageId' => $locale])
            ->one();

        if ($root === null) {
            return '';
        }

        $rootLevel = $root->getLevel();
        $groups = [];
        $currentGroup = null;
        foreach ($root->relativeQuery()
            ->children()
            ->includeDescendants()
            ->andWhere(['<=', 'level', $rootLevel + 2])
            ->each() as $node) {
            if ($node->getLevel() === $rootLevel + 1) {
                if ($currentGroup !== null) {
                    $groups[] = $currentGroup;
                }
                $currentGroup = [
                    'name' => $node->getName(),
                    'items' => [],
                ];
            } elseif ($node->getLevel() === $rootLevel + 2 && $currentGroup !== null) {
                $currentGroup['items'][] = $node;
            }
        }
        if ($currentGroup !== null) {
            $groups[] = $currentGroup;
        }

        return $this->renderView('footer/footer-links', [
            'groups' => $groups,
            'urlGenerator' => $this->urlGenerator,
        ]);
    }
}
