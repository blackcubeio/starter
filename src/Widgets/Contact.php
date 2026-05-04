<?php

declare(strict_types=1);

namespace App\Widgets;

final class Contact extends AbstractWidget
{
    public function render(): string
    {
        return $this->renderView('contact', [
            'elastic' => $this->elastic,
        ]);
    }
}
