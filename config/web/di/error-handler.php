<?php

declare(strict_types=1);

use Blackcube\Ssr\ThrowableResponseFactory;
use Yiisoft\Definitions\Reference;
use Yiisoft\ErrorHandler\RendererProvider\CompositeRendererProvider;
use Yiisoft\ErrorHandler\RendererProvider\ContentTypeRendererProvider;
use Yiisoft\ErrorHandler\RendererProvider\HeadRendererProvider;
use Yiisoft\ErrorHandler\RendererProvider\RendererProviderInterface;
use Yiisoft\ErrorHandler\ThrowableResponseFactory as YiiThrowableResponseFactory;
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
        'class' => ThrowableResponseFactory::class,
        '__construct()' => [
            'defaultFactory' => Reference::to(YiiThrowableResponseFactory::class),
        ],
    ],
];
