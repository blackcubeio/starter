<?php

declare(strict_types=1);

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
