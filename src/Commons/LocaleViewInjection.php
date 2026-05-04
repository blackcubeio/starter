<?php

declare(strict_types=1);

namespace App\Commons;

use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Yii\View\Renderer\CommonParametersInjectionInterface;

final class LocaleViewInjection implements CommonParametersInjectionInterface
{
    public function __construct(
        private readonly LocaleProvider $localeProvider,
    ) {
    }

    public function getCommonParameters(): array
    {
        return [
            'locale' => $this->localeProvider->get()->asString(),
            'localeProvider' => $this->localeProvider,
        ];
    }
}
