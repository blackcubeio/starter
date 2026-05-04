<?php

declare(strict_types=1);

namespace App\Widgets;

final class Stats extends AbstractGroupWidget
{
    public function render(): string
    {
        return $this->renderView('stats', [
            'elastics' => $this->elastics,
        ]);
    }
}
