<?php

declare(strict_types=1);

/**
 * Features.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets;

use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Translator\TranslatorInterface;

class Features extends AbstractGroupWidget
{
    public function __construct(
        array $elastics,
        LocaleProvider $localeProvider,
        private readonly ?TranslatorInterface $translator = null,
    ) {
        parent::__construct($elastics, $localeProvider);
    }

    public function render(): string
    {
        return $this->renderView('features', [
            'elastics' => $this->elastics,
            'translator' => $this->translator,
        ]);
    }
}
