<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

return [
    '@root' => dirname(__DIR__, 2),
    '@src' => '@root/src',
    '@data' => '@root/data',
    '@public' => '@root/www',
    '@assets' => '@public/assets',
    '@baseUrl' => '/',
    '@assetsUrl' => '/assets',
    '@cache' => '@public/cache',
    '@cacheUrl' => '/cache',
    '@runtime' => '@root/runtime',
    '@vendor' => '@root/vendor',
];