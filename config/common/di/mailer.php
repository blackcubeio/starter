<?php

declare(strict_types=1);

/**
 * mailer.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

use App\AppEnvironment;
use App\Services\MailjetService;
use Mailjet\Client;
use Yiisoft\Mailer\MailerInterface;

$appEnvironment = AppEnvironment::create();

$config = [];
if ($appEnvironment->isMailjetEnabled()) {
    $config[Client::class] = [
        'class' => Client::class,
        '__construct()' => [
            'key' => $appEnvironment->getMailjetApiKey() ?? '',
            'secret' => $appEnvironment->getMailjetApiSecret() ?? '',
            'call' => true,
            'settings' => ['version' => 'v3.1'],
        ],
    ];
    $config[MailerInterface::class] = MailjetService::class;
}
return $config;
