<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets;

/**
 * Stat bloc widget.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
class Stat extends AbstractWidget
{
    public function render(): string
    {
        return $this->renderView('stat', [
            'elastic' => $this->elastic,
        ]);
    }
}
