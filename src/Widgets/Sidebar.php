<?php

declare(strict_types=1);

namespace App\Widgets;

use Blackcube\Dcore\Entities\Content;
use RuntimeException;
use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Widget\Widget;

final class Sidebar extends AbstractBaseWidget
{
    public function __construct(
        private readonly LocaleProvider $localeProvider,
    ) {
    }

    public function render(): string
    {
        $locale = $this->localeProvider->get()->asString();

        $root = Content::query()
            ->andWhere(['id' => 1])
            ->one();

        if ($root === null) {
            return '';
        }

        $langRoot = $root->relativeQuery()
            ->children()
            ->andWhere(['languageId' => $locale])
            ->one();

        if ($langRoot === null) {
            return '';
        }

        $langRootLevel = $langRoot->getLevel();

        $groups = [];
        $currentGroup = null;
        foreach ($langRoot->relativeQuery()
            ->children()
            ->includeDescendants()
            ->andWhere(['<=', 'level', $langRootLevel + 2])
            ->each() as $node) {
            if ($node->getLevel() === $langRootLevel + 1) {
                if ($currentGroup !== null) {
                    $groups[] = $currentGroup;
                }
                $currentGroup = [
                    'name' => $node->getName(),
                    'node' => $node,
                    'items' => [],
                ];
            } elseif ($node->getLevel() === $langRootLevel + 2 && $currentGroup !== null) {
                $currentGroup['items'][] = $node;
            }
        }
        if ($currentGroup !== null) {
            $groups[] = $currentGroup;
        }

        return $this->renderView('sidebar', [
            'groups' => $groups,
        ]);
    }
}
