<?php

declare(strict_types=1);

namespace App\Widgets;

final class Feature extends AbstractWidget
{
    public function render(): string
    {
        return $this->renderView('feature', [
            'elastic' => $this->elastic,
            'locale' => $this->localeProvider->get()->asString(),
        ]);
    }
}
