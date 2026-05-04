<?php

declare(strict_types=1);

namespace App\Widgets;

final class Hero extends AbstractWidget
{
    public function render(): string
    {
        return $this->renderView('hero', [
            'elastic' => $this->elastic,
        ]);
    }
}
