<?php

declare(strict_types=1);

/**
 * Faq.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets;

class Faq extends AbstractWidget
{
    public function render(): string
    {
        return $this->renderView('faq', [
            'elastic' => $this->elastic,
        ]);
    }
}
