<?php

declare(strict_types=1);

namespace App\Widgets;

final class Cta extends AbstractWidget
{
    public function render(): string
    {
        return $this->renderView('cta', [
            'elastic' => $this->elastic,
        ]);
    }
}
