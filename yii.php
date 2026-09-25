<?php

declare(strict_types=1);

/**
 * yii.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

use Dotenv\Dotenv;
use Yiisoft\Yii\Runner\Console\ConsoleApplicationRunner;

require_once __DIR__.'/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$runner = new ConsoleApplicationRunner(
    rootPath:__DIR__,
    debug: true,
    checkEvents: false,
    environment: null
);

$runner->run();