<?php

declare(strict_types=1);

namespace App\Widgets;

use RuntimeException;
use Yiisoft\Widget\Widget;

abstract class AbstractBaseWidget extends Widget
{
    protected function renderView(string $viewName, array $params = []): string
    {
        $viewFile = __DIR__ . '/Views/' . $viewName . '.php';

        if (!file_exists($viewFile)) {
            throw new RuntimeException("View file not found: {$viewFile}");
        }

        extract($params, EXTR_OVERWRITE);
        ob_start();
        include $viewFile;
        return ob_get_clean();
    }
}
