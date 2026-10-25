<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Helpers;

/**
 * Tailwind classes of a heading for its level (1 to 6), shared by the widgets.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
class HeadingClass
{
    public static function for(int $level): string
    {
        return match ($level) {
            1 => 'text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-bold tracking-tight leading-none',
            2 => 'text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight leading-none',
            3 => 'text-2xl md:text-3xl font-semibold tracking-tight',
            4 => 'text-xl font-semibold tracking-tight',
            5 => 'text-lg font-semibold tracking-tight',
            6 => 'text-base font-semibold tracking-tight',
            default => 'text-base font-semibold tracking-tight',
        };
    }
}
