<?php

declare(strict_types=1);

namespace App\Widgets;

final class Media extends AbstractWidget
{
    public function render(): string
    {
        return $this->renderView('media', [
            'elastic' => $this->elastic,
        ]);
    }
}
