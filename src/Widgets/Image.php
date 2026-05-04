<?php

declare(strict_types=1);

namespace App\Widgets;

final class Image extends AbstractWidget
{
    public function render(): string
    {
        return $this->renderView('image', [
            'elastic' => $this->elastic,
        ]);
    }
}
