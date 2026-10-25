<?php

declare(strict_types=1);

/**
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
 * Base of the bloc widgets: one elastic (a bloc, or the properties of a content)
 * rendered by its view.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
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
