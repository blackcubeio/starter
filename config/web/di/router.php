<?php

declare(strict_types=1);

/**
 * router.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

use Yiisoft\Config\Config;
use Yiisoft\Definitions\DynamicReference;
use Yiisoft\Router\FastRoute\UrlMatcher;
use Yiisoft\Router\RouteCollection;
use Yiisoft\Router\RouteCollectionInterface;
use Yiisoft\Router\RouteCollector;
use Yiisoft\Router\UrlMatcherInterface;

/** @var Config $config */

/** @var array $params */

return [
    RouteCollectionInterface::class => [
        'class' => RouteCollection::class,
        '__construct()' => [
            'collector' => DynamicReference::to(
                static function () use ($config): RouteCollector {
                    return (new RouteCollector())->addRoute(...$config->get('routes'));
                },
            ),
        ],
    ],
    UrlMatcherInterface::class => [
        'class' => UrlMatcher::class,
        '__construct()' => [
            'config' => [
                UrlMatcher::CONFIG_CACHE_KEY => $params['yiisoft/router-fastroute']['cacheKey'] ?? null,
            ],
        ],
    ],
];
