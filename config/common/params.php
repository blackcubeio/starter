<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

use Blackcube\Bleet\Command\BleetDemo;
use Blackcube\Mcp\Dboard\McpAddon;
use App\AppEnvironment;
use Psr\Log\LogLevel;

$appEnvironment = AppEnvironment::create();

$fileProviderConfig = [
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
        'path' => '@cache',
        'url' => '@cacheUrl',
    ],
    /**/
];
if ($appEnvironment->getFsType() === 'local') {
    $fileProviderConfig['filesystems']['@blfs'] = [
        'type' => 'local',
        'path' => $appEnvironment->getFsLocalPath()
    ];
} elseif ($appEnvironment->getFsType() === 's3') {
    $fileProviderConfig['filesystems']['@blfs'] = [
        'type' => 's3',
        'key' => $appEnvironment->getFsS3Key(),
        'secret' => $appEnvironment->getFsS3Secret(),
        'region' => $appEnvironment->getFsS3Region(),
        'bucket' => $appEnvironment->getFsS3Bucket(),
        'endpoint' => $appEnvironment->getFsS3Endpoint(),
        'pathStyleEndpoint' => $appEnvironment->getFsS3PathStyle(),
    ];
}
return [
    'application' => [
        'charset' => 'UTF-8',
        'locale' => 'en',
        'name' => $appEnvironment->getName() ?? 'Demo',
    ],

    'yiisoft/aliases' => [
        'aliases' => require __DIR__ . '/aliases.php',
    ],

    'yiisoft/db-migration' => [
        'sourceNamespaces' => [
            'Blackcube\\Dboard\\Migrations',
            'Blackcube\\Dcore\\Migrations',
            'Blackcube\\Mcp\\Migrations',
            'App\\Migrations',
        ],
    ],
    'yiisoft/translator' => [
        'locale' => 'fr',
        'fallbackLocale' => null,
        'defaultCategory' => 'dboard',
    ],
    'yiisoft/validator' => [
        'translation.category' => 'app-validators',
    ],
    'blackcube/dboard' => [
        'oauth2' => [
            'issuer' => 'dboard',
            'algorithm' => 'RS256',
            'rsPublicKey' => dirname(__DIR__) . ($appEnvironment->getOauth2PublicKey() ?? '/keys/public.pem'),
            'rsPrivateKey' => dirname(__DIR__) . ($appEnvironment->getOauth2PrivateKey() ?? '/keys/private.pem'),
        ],
        'adminTemplatesAlias' => '@src/AdminTemplates',
        'addons' => [
            'mcp' => [
                'rbac' => [McpAddon::class, 'getRbac'],
                'sidebar' => [McpAddon::class, 'getSidebar'],
                'routes' => [McpAddon::class, 'getRoutesGroup'],
                'population' => [
                    McpAddon::class,
                    'getPopulation',
                ],
                'scopes' => [
                    McpAddon::class,
                    'getScopes',
                ],
            ],
        ],
    ],

    'blackcube/mcp' => [
        'endpoint' => '/mcp',
        'maxTtlDays' => 180,
        'defaultTtlDays' => 90,
        'allowedHosts' => $appEnvironment->getMcpAllowedHosts(),
    ],

    'blackcube/ssr' => [
        'scanAttributes' => true,
        'scanAliases' => ['@src/Handlers'],
        'configHandlers' => [
            // 'default' => [\App\Handler\DefaultHandler::class, 'handle'],
        ],
    ],

    'blackcube/fileprovider' => $fileProviderConfig,
];
