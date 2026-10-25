<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets;

use Blackcube\Dcore\Entities\Content;
use Blackcube\Dcore\Entities\Tag;
use Yiisoft\I18n\LocaleProvider;

/**
 * Page sidebar: navigation built from the content tree, with an optional title.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
class Sidebar extends AbstractBaseWidget
{
    private Content|Tag|null $element = null;
    private ?string $title = null;

    public function __construct(
        private readonly LocaleProvider $localeProvider,
    ) {
    }

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
        if ($this->element === null) {
            return '';
        }

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
        if ($langRoot === null) {
            return '';
        }

        $langRootLevel = $langRoot->getLevel();

        $groups = [];
        $currentGroup = null;
        foreach ($langRoot->relativeQuery()
            ->children()
            ->includeDescendants()
            ->andWhere([
                '<=',
                'level',
                $langRootLevel + 2,
            ])
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
            'title' => $this->title,
            'groups' => $groups,
        ]);
    }
}
