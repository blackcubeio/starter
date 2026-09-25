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

use Blackcube\Bleet\Command\BleetDemo;
use Blackcube\Mcp\Dboard\McpAddon;
use App\AppEnvironment;
use Psr\Log\LogLevel;

$appEnvironment = AppEnvironment::create();

return [
    'application' => [
        'charset' => 'UTF-8',
        'locale' => 'en',
        'name' => $appEnvironment->getName() ?? 'Demo',
    ],

    'yiisoft/aliases' => [
        'aliases' => require __DIR__.'/aliases.php',
    ],

    'yiisoft/db-migration' => [
        'sourceNamespaces' => [
            'Blackcube\\Dboard\\Migrations',
            'Blackcube\\Dcore\\Migrations',
            'Blackcube\\Mcp\\Migrations',
        ],
    ],
    'yiisoft/translator' => [
        'locale' => 'fr',
        'fallbackLocale' => null,
        'defaultCategory' => 'dboard',
    ],
    'blackcube/dboard' => [
        'oauth2' => [
            'issuer' => 'dboard',
            'algorithm' => 'RS256',
            'rsPublicKey' => dirname(__DIR__).($appEnvironment->getOauth2PublicKey() ?? '/keys/public.pem'),
            'rsPrivateKey' => dirname(__DIR__).($appEnvironment->getOauth2PrivateKey() ?? '/keys/private.pem'),
        ],
        'adminTemplatesAlias' => '@src/AdminTemplates',
        'addons' => [
            'mcp' => [
                'rbac' => [McpAddon::class, 'getRbac'],
                'sidebar' => [McpAddon::class, 'getSidebar'],
                'routes' => [McpAddon::class, 'getRoutesGroup'],
            ],
        ],
    ],
    'blackcube/mcp' => [
        'endpoint' => '/mcp',
        'maxTtlDays' => 180,
        'defaultTtlDays' => 90,
        'allowedHosts' => ['starter.discovery.gaultier.intra', 'localhost', '127.0.0.1', '[::1]'],
    ],

    'blackcube/ssr' => [
        'scanAttributes' => true,
        'scanAliases' => ['@src/Handlers'],
        'configHandlers' => [
        ],
    ],

    'blackcube/fileprovider' => [
        'filesystems' => [
            '@blfs' => [
                'type' => 'local',
                'path' => '@root/data',
            ],
            '@bltmp' => [
                'type' => 'local',
                'path' => '@runtime/blackcube/tmp',
            ],
        ],
        'defaultAlias' => '@blfs',
        'imageDriver' => null,
        /**/
        'cache' => [
            'path' => '@assets',
            'url' => '@assetsUrl',
        ],
        /**/
    ],
];
