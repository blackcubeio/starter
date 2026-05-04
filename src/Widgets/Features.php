<?php

declare(strict_types=1);

namespace App\Widgets;

final class Features extends AbstractGroupWidget
{
    public function render(): string
    {
        return $this->renderView('features', [
            'elastics' => $this->elastics,
        ]);
    }
}
