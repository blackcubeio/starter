<?php

declare(strict_types=1);

/**
 * redis.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

use App\AppEnvironment;
use Predis\Client;

$appEnvironment = AppEnvironment::create();

$config = [];
if ($appEnvironment->isRedisEnabled()) {
    $config[Client::class] = [
        'class' => Client::class,
        '__construct()' => [
            [
                'scheme' => 'tcp',
                'host' => $appEnvironment->getRedisHost(),
                'port' => $appEnvironment->getRedisPort(),
                'database' => $appEnvironment->getRedisDatabase(),
                'password' => $appEnvironment->getRedisPassword(),
            ],
        ],
    ];
}
return $config;
