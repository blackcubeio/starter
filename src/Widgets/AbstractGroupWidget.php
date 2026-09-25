<?php

declare(strict_types=1);

/**
 * AbstractGroupWidget.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets;

use Blackcube\ActiveRecord\Elastic\ElasticInterface;
use RuntimeException;
use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Widget\Widget;

/**
 * Base class for group widgets that render multiple blocs inside a wrapper.
 */
abstract class AbstractGroupWidget extends AbstractBaseWidget
{
    /**
     * @param ElasticInterface[] $elastics
     */
    public function __construct(
        protected array $elastics,
        LocaleProvider $localeProvider,
    ) {
        parent::__construct($localeProvider);
    }
}
