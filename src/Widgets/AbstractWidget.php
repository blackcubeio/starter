<?php

declare(strict_types=1);

/**
 * AbstractWidget.php
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

abstract class AbstractWidget extends AbstractBaseWidget
{
    public function __construct(
        protected ElasticInterface $elastic,
        LocaleProvider $localeProvider,
    ) {
        parent::__construct($localeProvider);
    }

    public function getElastic(): ElasticInterface
    {
        return $this->elastic;
    }
}
