<?php

declare(strict_types=1);

namespace App\Widgets;

final class Stat extends AbstractWidget
{
    public function render(): string
    {
        return $this->renderView('stat', [
            'elastic' => $this->elastic,
        ]);
    }
}
