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

/**
 * Links to the previous and next sibling pages, shown from the third tree level down.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
class PrevNext extends AbstractBaseWidget
{
    private Content|Tag|null $element = null;

    public function element(Content|Tag $element): self
    {
        $this->element = $element;
        return $this;
    }

    public function render(): string
    {
        if ($this->element === null || $this->element->getLevel() < 3) {
            return '';
        }

        $prev = $this->element->relativeQuery()->siblings()->previous()->one();
        $next = $this->element->relativeQuery()->siblings()->next()->one();

        $prevUrl = $this->getUrlFromNode($prev);
        $nextUrl = $this->getUrlFromNode($next);

        if ($prevUrl === null && $nextUrl === null) {
            return '';
        }

        return $this->renderView('prev-next', [
            'prev' => $prev,
            'next' => $next,
            'prevUrl' => $prevUrl,
            'nextUrl' => $nextUrl,
        ]);
    }

    private function getUrlFromNode(Content|Tag|null $node): ?string
    {
        $slug = $node?->getSlugQuery()->one();
        return ($slug !== null) ? $slug->getLink()->getHref() : null;
    }
}
