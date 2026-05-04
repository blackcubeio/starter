<?php

declare(strict_types=1);

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
        protected LocaleProvider $localeProvider,
    ) {
    }
}
