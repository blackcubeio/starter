<?php

declare(strict_types=1);

use Yiisoft\Config\Config;
use Yiisoft\Definitions\DynamicReference;
use Yiisoft\Injector\Injector;
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
                static fn() => (new RouteCollector())->addRoute(...$config->get('routes')),
            ),
        ],
    ],
    UrlMatcherInterface::class => static function (Injector $injector) use ($params) {
        $enableCache = $params['yiisoft/router-fastroute']['enableCache'] ?? true;
        $cacheKey = $params['yiisoft/router-fastroute']['cacheKey'] ?? null;

        $arguments = [];
        if ($enableCache === false) {
            $arguments['cache'] = null;
        }
        if ($cacheKey !== null) {
            $arguments['config'] = [UrlMatcher::CONFIG_CACHE_KEY => $cacheKey];
        }

        return $injector->make(UrlMatcher::class, $arguments);
    },
];