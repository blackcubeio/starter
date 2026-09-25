<?php

declare(strict_types=1);

/**
 * params.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

use Yiisoft\Aliases\Aliases;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Definitions\Reference;
use Yiisoft\Router\CurrentRoute;
use Yiisoft\Router\UrlGeneratorInterface;
use App\Commons\LocaleViewInjection;
use Yiisoft\Yii\View\Renderer\CsrfViewInjection;

return [

    'yiisoft/router-fastroute' => [
        'cacheKey' => 'yii.router',
    ],

    'yiisoft/assets' => [
        'basePath' => '@assets',
        'baseUrl' => '@assetsUrl',
    ],

    'yiisoft/view' => [
        'basePath' => null,
        'parameters' => [
            'assetManager' => Reference::to(AssetManager::class),
            'aliases' => Reference::to(Aliases::class),
            'urlGenerator' => Reference::to(UrlGeneratorInterface::class),
            'currentRoute' => Reference::to(CurrentRoute::class),
        ],
    ],

    'yiisoft/yii-view-renderer' => [
        'viewPath' => '@src/Web/Views',
        'layout' => '@src/Web/Views/Layout/main.php',
        'injections' => [
            Reference::to(CsrfViewInjection::class),
            Reference::to(LocaleViewInjection::class),
            Reference::to(\Blackcube\Dboard\Services\ViewInjection::class),
        ],
    ],
];