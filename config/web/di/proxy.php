<?php

declare(strict_types=1);

/**
 * proxy.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

use App\AppEnvironment;
use Blackcube\ProxyMiddleware\TrustedHostsNetworkResolver;

$appEnvironment = AppEnvironment::create();
$trustedHosts = $appEnvironment->getTrustedHosts();

$config = [];
if (empty($trustedHosts) === false) {
    $config = [
        TrustedHostsNetworkResolver::class => [
            'withTrustedIps()' => [$trustedHosts],
        ],
    ];
}

return $config;
