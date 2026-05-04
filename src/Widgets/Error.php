<?php

declare(strict_types=1);

namespace App\Widgets;

use Throwable;

final class Error extends AbstractWidget
{
    private ?Throwable $exception = null;

    public function setException(?Throwable $exception): self {
        $this->exception = $exception;
        return $this;
    }

    public function render(): string
    {
        return $this->renderView('error', [
            'elastic' => $this->elastic,
            'exception' => $this->exception,
        ]);
    }
}
