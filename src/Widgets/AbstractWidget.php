<?php

declare(strict_types=1);

namespace App\Widgets;

use Blackcube\ActiveRecord\Elastic\ElasticInterface;
use RuntimeException;
use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Widget\Widget;

abstract class AbstractWidget extends AbstractBaseWidget
{
    public function __construct(
        protected ElasticInterface $elastic,
        protected LocaleProvider $localeProvider,
    ) {
    }

    public function getElastic(): ElasticInterface
    {
        return $this->elastic;
    }
}
