<?php

declare(strict_types=1);

/**
 * TarteAuCitronAsset.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Assets;

use App\AppEnvironment;
use Yiisoft\Assets\AssetBundle;
use Yiisoft\View\WebView;

/**
 * Bundle pour les ressources statiques (images, icônes).
 */
class TarteAuCitronAsset extends AssetBundle
{
    public function __construct() {
        $env = AppEnvironment::create();
        $vars = [
            'services' => $env->getTacServices(),
            'init' => [
                'showIcon' => $env->getTacShowIcon(),
            ]
        ];
        $matomoId = $env->getTacMatomoId();
        $matomoHost = $env->getTacMatomoHost();
        if ($matomoId !== null && $matomoHost !== null) {
            $vars['options'] = [
                'matomoId' => $matomoId,
                'matomoHost' => $matomoHost,
            ];
        }
        $this->jsVars['tac'] = $vars;
    }
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@src/Assets/TarteAuCitron';
    public array $js = [
        ['js/tarteaucitron.js', WebView::POSITION_HEAD],
    ];
    public array $jsOptions = [
        'defer' => 'defer',
    ];

}
