<?php

declare(strict_types=1);

/**
 * cache.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

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
