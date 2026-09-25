<?php

declare(strict_types=1);

/**
 * main.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
/**
 * @var Yiisoft\Aliases\Aliases $aliases
 * @var Yiisoft\Assets\AssetManager $assetManager
 * @var string $content
 * @var string|null $csrf
 * @var Yiisoft\View\WebView $this
 * @var Yiisoft\Router\CurrentRoute $currentRoute
 * @var Yiisoft\Router\UrlGeneratorInterface $urlGenerator
 */

use App\Assets\AppAsset;
use App\Assets\FaviconAsset;

$assetManager->register(AppAsset::class);
$assetManager->register(FaviconAsset::class);
$this->addCssFiles($assetManager->getCssFiles());
$this->addCssStrings($assetManager->getCssStrings());
$this->addJsFiles($assetManager->getJsFiles());
$this->addJsStrings($assetManager->getJsStrings());
$this->addJsVars($assetManager->getJsVars());
$bundle = $assetManager->getBundle(AppAsset::class);
$this->registerJsVar('webpackBaseUrl', $bundle->baseUrl.'/');

$this->beginPage();
?>
    <!DOCTYPE html>
    <?php echo Yiisoft\Html\Html::openTag('html', [
            'lang' => $htmlLang ?? 'en',
    ]); ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>
            (function () {
                try {
                    var stored = localStorage.getItem('bc-mode');
                    var isDark = false;
                    if (stored !== null) {
                        isDark = JSON.parse(stored) === 'dark';
                    } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        isDark = true;
                    }
                    if (isDark) {
                        document.documentElement.classList.add('dark');
                    }
                } catch (e) {}
            })();
        </script>
        <title><?php echo Yiisoft\Html\Html::encode($pageTitle ?? ''); ?></title>
        <?php $this->head(); ?>
    </head>
    <body class="bg-white dark:bg-primary-900 text-secondary-800 dark:text-secondary-200 font-sans antialiased">
        <?php $this->beginBody(); ?>
            <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-[100] focus:px-4 focus:py-2 focus:bg-primary-700 focus:text-white focus:rounded-lg">Aller au contenu principal</a>
            <?php echo $content; ?>
        <?php $this->endBody(); ?>
    </body>
    <?php echo Yiisoft\Html\Html::closeTag('html'); ?>
<?php $this->endPage(); ?>