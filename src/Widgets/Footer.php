<?php

declare(strict_types=1);

/**
 * Footer.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets;

class Footer extends AbstractMenuNavigationWidget
{
    protected function getMenuName(): string
    {
        return 'Footer';
    }

    public function render(): string
    {
        return $this->renderView('footer', [
            'homeUrl' => $this->homeUrl(),
            'navItems' => $this->buildNavItems(),
        ]);
    }
}
