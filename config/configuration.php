<?php

declare(strict_types=1);

/**
 * configuration.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

return [
    'config-plugin' => [
        'params' => 'common/params.php',
        'params-console' => [
            '$params',
            'console/params.php',
        ],
        'params-web' => [
            '$params',
            'web/params.php',
        ],
        'di' => 'common/di/*.php',
        'di-console' => '$di',
        'di-web' => [
            '$di',
            'web/di/*.php',
        ],
        'di-delegates' => [],
        'di-delegates-console' => '$di-delegates',
        'di-delegates-web' => '$di-delegates',
        'di-providers' => [],
        'di-providers-console' => [
            '$di-providers',
        ],
        'events' => [],
        'events-console' => ['$events'],
        'events-web' => ['$events'],
        'bootstrap' => 'common/bootstrap.php',
        'bootstrap-console' => '$bootstrap',
        'bootstrap-web' => '$bootstrap',
        'routes' => 'web/routes.php',
    ],
    'config-plugin-options' => [
        'source-directory' => 'config',
    ],
];