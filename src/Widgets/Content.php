<?php

declare(strict_types=1);

namespace App\Widgets;

final class Content extends AbstractWidget
{
    public function render(): string
    {
        return $this->renderView('content', [
            'elastic' => $this->elastic,
        ]);
    }
}
