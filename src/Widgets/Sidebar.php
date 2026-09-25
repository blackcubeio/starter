<?php

declare(strict_types=1);

/**
 * Sidebar.php
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

class Sidebar extends AbstractBaseWidget
{
    private Content|Tag|null $element = null;
    private ?string $title = null;

    public function element(Content|Tag $element): self
    {
        $this->element = $element;
        return $this;
    }

    public function title(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function render(): string
    {
        $html = '';
        if ($this->element !== null) {
            $locale = $this->localeProvider->get()->asString();

            $treeRoot = $this->element->relativeQuery()
                ->parent()
                ->includeAncestors()
                ->orderBy(['level' => SORT_ASC])
                ->limit(1)
                ->one();
            if ($treeRoot === null) {
                $treeRoot = $this->element;
            }

            $langRoot = $treeRoot->relativeQuery()
                ->children()
                ->andWhere(['languageId' => $locale])
                ->one();
            if ($langRoot !== null) {
                $langRootLevel = $langRoot->getLevel();

                $currentSection = null;
                if ($this->element->getLevel() === $langRootLevel + 1) {
                    $currentSection = $this->element;
                } elseif ($this->element->getLevel() > $langRootLevel + 1) {
                    $currentSection = $this->element->relativeQuery()
                        ->parent()
                        ->includeAncestors()
                        ->andWhere(['level' => $langRootLevel + 1])
                        ->one();
                }

                $navRoot = $langRoot;
                if ($currentSection !== null) {
                    $currentSectionChildrenCount = $currentSection->relativeQuery()
                        ->children()
                        ->count();
                    if ($currentSectionChildrenCount > 0) {
                        $navRoot = $currentSection;
                    }
                }
                $navRootLevel = $navRoot->getLevel();

                $groups = [];
                $currentGroup = null;
                foreach ($navRoot->relativeQuery()
                    ->children()
                    ->includeDescendants()
                    ->andWhere(['<=', 'level', $navRootLevel + 2])
                    ->each() as $node) {
                    if ($node->getLevel() === $navRootLevel + 1) {
                        if ($currentGroup !== null) {
                            $groups[] = $currentGroup;
                        }
                        $currentGroup = [
                            'name' => $node->getName(),
                            'node' => $node,
                            'items' => [],
                        ];
                    } elseif ($node->getLevel() === $navRootLevel + 2 && $currentGroup !== null) {
                        $currentGroup['items'][] = $node;
                    }
                }
                if ($currentGroup !== null) {
                    $groups[] = $currentGroup;
                }

                $html = $this->renderView('sidebar', [
                    'title' => $this->title,
                    'groups' => $groups,
                ]);
            }
        }
        return $html;
    }
}
