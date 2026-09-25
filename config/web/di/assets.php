<?php

declare(strict_types=1);

/**
 * assets.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

use Blackcube\Assets\ManifestAssetLoader;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Assets\AssetLoader;
use Yiisoft\Assets\AssetLoaderInterface;
use Yiisoft\Definitions\Reference;

/**
 * DI configuration for ManifestAssetLoader decorator.
 *
 * Automatically decorates the standard AssetLoader to support
 * manifest-based bundles (Vite/Webpack).
 */
return [
    AssetLoaderInterface::class => [
        'class' => ManifestAssetLoader::class,
        '__construct()' => [
            'innerLoader' => Reference::to(AssetLoader::class),
            'aliases' => Reference::to(Aliases::class),
        ],
    ],
];
