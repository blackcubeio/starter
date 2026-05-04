<?php

declare(strict_types=1);

/**
 * @var Yiisoft\Aliases\Aliases $aliases
 * @var Yiisoft\Assets\AssetManager $assetManager
 * @var string $content
 * @var string|null $csrf
 * @var Yiisoft\View\WebView $this
 * @var Yiisoft\Router\CurrentRoute $currentRoute
 * @var Yiisoft\Router\UrlGeneratorInterface $urlGenerator
 */

use Blackcube\Bleet\Bleet;
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
$this->registerJsVar('webpackBaseUrl', $bundle->baseUrl . '/');

$this->beginPage()
?>
    <!DOCTYPE html>
    <?php echo Yiisoft\Html\Html::openTag('html', [
            'lang' => $htmlLang ?? 'en',
    ]) ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- base href="/" -->
        <title><?php echo \Yiisoft\Html\Html::encode($pageTitle ?? '') ?></title>
        <?php $this->head() ?>
    </head>
    <body class="bg-white dark:bg-secondary-900 text-secondary-800 dark:text-secondary-200 font-sans antialiased">
        <?php $this->beginBody() ?>
            <?php echo $content ?>
        <?php $this->endBody() ?>
    </body>
    <?php echo Yiisoft\Html\Html::closeTag('html') ?>
<?php $this->endPage() ?>