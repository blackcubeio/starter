<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Yiisoft\Db\Connection\ConnectionProvider;
use Yiisoft\Db\Connection\ConnectionInterface;

return [
    static function (ContainerInterface $container): void {
        ConnectionProvider::set($container->get(ConnectionInterface::class));
    }
];