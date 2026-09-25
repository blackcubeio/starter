<?php

declare(strict_types=1);

/**
 * Error.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets;

use Throwable;

class Error extends AbstractWidget
{
    private ?Throwable $exception = null;
    private ?int $httpCode = null;
    private ?string $path = null;
    private bool $debug = false;

    public function setException(?Throwable $exception): self
    {
        $this->exception = $exception;
        return $this;
    }

    public function setHttpCode(?int $httpCode): self
    {
        $this->httpCode = $httpCode;
        return $this;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;
        return $this;
    }

    public function setDebug(bool $debug): self
    {
        $this->debug = $debug;
        return $this;
    }

    public function render(): string
    {
        $locale = $this->localeProvider->get()->asString();
        return $this->renderView('error', [
            'elastic' => $this->elastic,
            'exception' => $this->exception,
            'httpCode' => $this->httpCode,
            'path' => $this->path,
            'locale' => $locale,
            'debug' => $this->debug,
        ]);
    }
}
