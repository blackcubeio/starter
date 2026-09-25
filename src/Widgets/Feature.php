<?php

declare(strict_types=1);

/**
 * Feature.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets;

use Blackcube\ActiveRecord\Elastic\ElasticInterface;
use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Translator\TranslatorInterface;

class Feature extends AbstractWidget
{
    public function __construct(
        ElasticInterface $elastic,
        LocaleProvider $localeProvider,
        private readonly ?TranslatorInterface $translator = null,
    ) {
        parent::__construct($elastic, $localeProvider);
    }

    public function render(): string
    {
        return $this->renderView('feature', [
            'elastic' => $this->elastic,
            'translator' => $this->translator,
        ]);
    }
}
