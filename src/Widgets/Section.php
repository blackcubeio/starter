<?php

declare(strict_types=1);

namespace App\Widgets;

final class Section extends AbstractWidget
{
    public function render(): string
    {
        return $this->renderView('section', [
            'elastic' => $this->elastic,
        ]);
    }
}
