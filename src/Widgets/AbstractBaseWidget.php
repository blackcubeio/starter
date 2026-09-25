<?php

declare(strict_types=1);

/**
 * AbstractBaseWidget.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets;

use Blackcube\Dcore\Entities\Content;
use RuntimeException;
use Yiisoft\Widget\Widget;
use Yiisoft\I18n\LocaleProvider;

abstract class AbstractBaseWidget extends Widget
{
    public function __construct(
        protected readonly LocaleProvider $localeProvider,
    ) {
    }

    protected function renderView(string $viewName, array $params = []): string
    {
        $viewFile = __DIR__.'/Views/'.$viewName.'.php';

        if (file_exists($viewFile) === false) {
            throw new RuntimeException('View file not found: '.$viewFile);
        }

        extract($params, EXTR_OVERWRITE);
        ob_start();
        include $viewFile;
        return ob_get_clean();
    }

    protected function homeUrl(?string $locale = null): string
    {
        $homeUrl = '/';
        $root = Content::query()->andWhere(['id' => 1])->one();
        if ($locale === null) {
            $locale = $this->localeProvider->get()->asString();
        }
        if ($root !== null) {
            $langRoot = $root->relativeQuery()
                ->with(['slug'])
                ->children()
                ->andWhere(['languageId' => $locale])
                ->one();
            $slug = $langRoot?->slug;
            if ($slug !== null) {
                $homeUrl = $slug->getLink()->getHref();
            }
        }
        return $homeUrl;
    }
}
