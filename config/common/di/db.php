<?php

declare(strict_types=1);

use App\AppEnvironment;
use Yiisoft\Db\Cache\SchemaCache;
use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Mysql\Connection;
use Yiisoft\Db\Mysql\Driver;
use Yiisoft\Definitions\Reference;

$appEnvironment = AppEnvironment::create();

return [
    Driver::class => [
        'class' => Driver::class,
        '__construct()' => [
            $appEnvironment->getDbDsn(),
            $appEnvironment->getDbUser(),
            $appEnvironment->getDbPassword(),
        ],
        'charset()' => ['UTF8MB4'],
    ],
    ConnectionInterface::class => [
        'class' => Connection::class,
        '__construct()' => [
            'driver' => Reference::to(Driver::class),
            'schemaCache' => Reference::to(SchemaCache::class),
        ],
    ],
];
