<?php

declare(strict_types=1);

/**
 * index.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

use Dotenv\Dotenv;
use Yiisoft\Yii\Runner\Http\HttpApplicationRunner;

require_once dirname(__DIR__).'/vendor/autoload.php';

Dotenv::createImmutable(dirname(__DIR__))->load();

$runner = new HttpApplicationRunner(
    rootPath: dirname(__DIR__),
    debug: true,
    checkEvents: false,
    environment: null,
);

$runner->run();