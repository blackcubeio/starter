<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Yiisoft\Yii\Runner\Http\HttpApplicationRunner;

require_once dirname(__DIR__) . '/vendor/autoload.php';

Dotenv::createImmutable(dirname(__DIR__))->load();

$runner = new HttpApplicationRunner(
    rootPath: dirname(__DIR__),
    debug: true,
    checkEvents: false,
    environment: null,
);

$runner->run();