<?php

declare(strict_types=1);

/**
 * error-handler.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

use Blackcube\Ssr\YiiThrowableResponseFactory;
use Yiisoft\Definitions\Reference;
use Yiisoft\ErrorHandler\RendererProvider\CompositeRendererProvider;
use Yiisoft\ErrorHandler\RendererProvider\ContentTypeRendererProvider;
use Yiisoft\ErrorHandler\RendererProvider\HeadRendererProvider;
use Yiisoft\ErrorHandler\RendererProvider\RendererProviderInterface;
use Yiisoft\ErrorHandler\ThrowableResponseFactory as DefaultThrowableResponseFactory;
use Yiisoft\ErrorHandler\ThrowableResponseFactoryInterface;

return [
    RendererProviderInterface::class => [
        'class' => CompositeRendererProvider::class,
        '__construct()' => [
            Reference::to(HeadRendererProvider::class),
            Reference::to(ContentTypeRendererProvider::class),
        ],
    ],
    ThrowableResponseFactoryInterface::class => [
        'class' => YiiThrowableResponseFactory::class,
        '__construct()' => [
            'defaultFactory' => Reference::to(DefaultThrowableResponseFactory::class),
        ],
    ],
];
