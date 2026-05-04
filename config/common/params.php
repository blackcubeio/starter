<?php

declare(strict_types=1);

use Blackcube\Bleet\Command\BleetDemo;
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
        'aliases' => require __DIR__ . '/aliases.php',
    ],

    'yiisoft/db-migration' => [
        'sourceNamespaces' => [
            'Blackcube\\Dboard\\Migrations',
            'Blackcube\\Dcore\\Migrations',
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
            'publicKey' => file_get_contents(dirname(__DIR__) . ($appEnvironment->getOauth2PublicKey() ?? 'public.pem')),
            'privateKey' => file_get_contents(dirname(__DIR__) . ($appEnvironment->getOauth2PrivateKey() ?? 'private.pem')),
        ],
        'adminTemplatesAlias' => '@src/AdminTemplates',
    ],

    'blackcube/ssr' => [
        'scanAttributes' => true,
        'scanAliases' => ['@src/Handlers'],
        'configHandlers' => [
            // 'default' => [\App\Handler\DefaultHandler::class, 'handle'],
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
