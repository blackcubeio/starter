<?php

declare(strict_types=1);

use App\AppEnvironment;
use Predis\Client;
use Psr\SimpleCache\CacheInterface;
use Yiisoft\Cache\Redis\RedisCache;
use Yiisoft\Definitions\Reference;

$appEnvironment = AppEnvironment::create();

$config = [];
if ($appEnvironment->isCacheEnabled() && $appEnvironment->isRedisEnabled()) {
    $config[CacheInterface::class] = [
        'class' => RedisCache::class,
        '__construct()' => [
            Reference::to(Client::class),
        ],
    ];
}
return $config;
