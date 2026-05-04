<?php

declare(strict_types=1);

use Yiisoft\Rbac\AssignmentsStorageInterface;
use Yiisoft\Rbac\Db\AssignmentsStorage;
use Yiisoft\Rbac\Db\ItemsStorage;
use Yiisoft\Rbac\ItemsStorageInterface;
use Yiisoft\Rbac\Manager;
use Yiisoft\Rbac\ManagerInterface;

return [
    ItemsStorageInterface::class => ItemsStorage::class,
    AssignmentsStorageInterface::class => AssignmentsStorage::class,
    ManagerInterface::class => [
        'class' => Manager::class,
        '__construct()' => [
            'enableDirectPermissions' => true,
        ],
    ],
];
