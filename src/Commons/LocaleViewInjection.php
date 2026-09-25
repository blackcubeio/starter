<?php

declare(strict_types=1);

/**
 * LocaleViewInjection.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Commons;

use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\Yii\View\Renderer\CommonParametersInjectionInterface;

class LocaleViewInjection implements CommonParametersInjectionInterface
{
    public function __construct(
        private readonly LocaleProvider $localeProvider,
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function getCommonParameters(): array
    {
        return [
            'locale' => $this->localeProvider->get()->asString(),
            'localeProvider' => $this->localeProvider,
            'translator' => $this->translator,
        ];
    }
}
