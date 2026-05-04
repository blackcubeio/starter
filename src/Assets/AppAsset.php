<?php

declare(strict_types=1);

namespace App\Assets;

use Blackcube\Assets\WebpackAssetBundle;
use Yiisoft\View\WebView;

final class AppAsset extends WebpackAssetBundle
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@src/Assets/App/dist-webpack';
    public array $css = [
        'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,500&family=JetBrains+Mono:wght@400;500;600&display=swap',
        ['https://fonts.googleapis.com', WebView::POSITION_HEAD, 'rel' => 'preconnect'],
        ['https://fonts.gstatic.com', WebView::POSITION_HEAD, 'rel' => 'preconnect', 'crossorigin' => 'crossorigin'],
    ];
}