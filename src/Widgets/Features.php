<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets;

use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Translator\TranslatorInterface;

/**
 * Group of consecutive feature blocs rendered together.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
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
