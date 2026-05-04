<?php

declare(strict_types=1);

namespace App\Widgets;

final class Images extends AbstractGroupWidget
{
    public function render(): string
    {
        return $this->renderView('images', [
            'elastics' => $this->elastics,
        ]);
    }
}
