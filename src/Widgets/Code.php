<?php

declare(strict_types=1);

namespace App\Widgets;

final class Code extends AbstractWidget
{
    public function render(): string
    {
        return $this->renderView('code', [
            'elastic' => $this->elastic,
        ]);
    }
}
