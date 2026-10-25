<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets;

/**
 * Group of consecutive image blocs rendered together.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
class Images extends AbstractGroupWidget
{
    public function render(): string
    {
        return $this->renderView('images', [
            'elastics' => $this->elastics,
        ]);
    }
}
