<?php

declare(strict_types=1);

/**
 * application.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

use Blackcube\Dboard\Middlewares\MultiVerbParserMiddleware;
use Blackcube\Ssr\YiiFallbackHandler;
use Blackcube\Ssr\Interfaces\SsrRoutingMiddlewareInterface;
use Yiisoft\DataResponse\Middleware\ContentNegotiatorDataResponseMiddleware;
use Yiisoft\Definitions\DynamicReference;
use Yiisoft\Definitions\Reference;
use Yiisoft\ErrorHandler\Middleware\ErrorCatcher;
use Yiisoft\Input\Http\HydratorAttributeParametersResolver;
use Yiisoft\Input\Http\RequestInputParametersResolver;
use Yiisoft\Middleware\Dispatcher\CompositeParametersResolver;
use Yiisoft\Middleware\Dispatcher\MiddlewareDispatcher;
use Yiisoft\Middleware\Dispatcher\ParametersResolverInterface;
use Yiisoft\RequestProvider\RequestCatcherMiddleware;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Session\SessionMiddleware;
use Yiisoft\Yii\Http\Application;
use Yiisoft\Yii\Http\Handler\NotFoundHandler;

/** @var array $params */

return [
    YiiFallbackHandler::class => [
        'class' => YiiFallbackHandler::class,
        '__construct()' => [
            'defaultHandler' => Reference::to(NotFoundHandler::class),
        ],
    ],
    Application::class => [
        '__construct()' => [
            'fallbackHandler' => Reference::to(YiiFallbackHandler::class),
            'dispatcher' => DynamicReference::to([
                'class' => MiddlewareDispatcher::class,
                'withMiddlewares()' => [
                    [
                        ErrorCatcher::class,
                        SessionMiddleware::class,
                        MultiVerbParserMiddleware::class,
                        ContentNegotiatorDataResponseMiddleware::class,
                        RequestCatcherMiddleware::class,
                        static function (SsrRoutingMiddlewareInterface $middleware) use ($params): SsrRoutingMiddlewareInterface {
                            return $middleware
                                ->withExcludedPrefixes(
                                    ltrim($params['blackcube/dboard']['routePrefix'] ?? '/dboard', '/').'/',
                                )
                                ->withXeo()
                                ->withMdAlternate();
                        },
                        Router::class,
                    ],
                ],
            ]),

        ],
    ],

    ParametersResolverInterface::class => [
        'class' => CompositeParametersResolver::class,
        '__construct()' => [
            Reference::to(HydratorAttributeParametersResolver::class),
            Reference::to(RequestInputParametersResolver::class),
        ],
    ],
];