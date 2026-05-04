<?php

declare(strict_types=1);

namespace App\Widgets;

final class Callout extends AbstractWidget
{
    public function render(): string
    {
        return $this->renderView('callout', [
            'elastic' => $this->elastic,
        ]);
    }
}
