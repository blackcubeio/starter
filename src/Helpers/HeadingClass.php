<?php

declare(strict_types=1);

/**
 * HeadingClass.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Helpers;

class HeadingClass
{
    public static function for(int $level): string
    {
        return match ($level) {
            1 => 'text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight',
            2 => 'text-3xl md:text-4xl font-bold tracking-tight',
            3 => 'text-2xl md:text-3xl font-bold tracking-tight',
            4 => 'text-xl font-semibold tracking-tight',
            5 => 'text-lg font-semibold tracking-tight',
            6 => 'text-base font-semibold tracking-tight',
            default => 'text-base font-semibold tracking-tight',
        };
    }

    public static function clamp(mixed $level, int $default = 2): int
    {
        return max(2, min(6, (int) ($level ?? $default)));
    }
}
