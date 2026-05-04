<?php

declare(strict_types=1);

use App\AppEnvironment;
use Blackcube\ProxyMiddleware\TrustedHostsNetworkResolver;

$appEnvironment = AppEnvironment::create();
$trustedHosts = $appEnvironment->getTrustedHosts();

if (empty($trustedHosts)) {
    return [];
}

return [
    TrustedHostsNetworkResolver::class => [
        'withTrustedIps()' => [$trustedHosts],
    ],
];
