<?php

declare(strict_types=1);

/**
 * locale.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

use Yiisoft\I18n\Locale;
use Yiisoft\I18n\LocaleProvider;

return [
    LocaleProvider::class => [
        'class' => LocaleProvider::class,
        '__construct()' => [
            'defaultLocale' => new Locale('en'),
        ],
    ],
];
