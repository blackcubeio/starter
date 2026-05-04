<?php

declare(strict_types=1);

namespace App\Widgets;

use Blackcube\Dcore\Entities\Content;
use Blackcube\Dcore\Entities\Tag;
use RuntimeException;
use Yiisoft\Widget\Widget;

final class PrevNext extends AbstractBaseWidget
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

        $prevUrl = $this->resolveUrl($prev);
        $nextUrl = $this->resolveUrl($next);

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

    private function resolveUrl(Content|Tag|null $node): ?string
    {
        if ($node === null || $node->getSlugId() === null) {
            return null;
        }
        $slug = $node->getSlugQuery()->one();
        if ($slug === null) {
            return null;
        }
        $link = $slug->getLink();
        return $link->isTemplated()
            ? '/' . ltrim($slug->getPath(), '/')
            : $link->getHref();
    }
}
