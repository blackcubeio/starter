<?php

declare(strict_types=1);

namespace App\Widgets;

final class Faq extends AbstractWidget
{
    public function render(): string
    {
        return $this->renderView('faq', [
            'elastic' => $this->elastic,
        ]);
    }
}
