<?php

declare(strict_types=1);

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
