<?php

declare(strict_types=1);

/**
 * Faqs.php
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

class Faqs extends AbstractGroupWidget
{
    private ?ElasticInterface $header;

    /**
     * @param ElasticInterface[] $elastics
     * @param ElasticInterface|null $header Section bloc absorbed as title
     */
    public function __construct(array $elastics, LocaleProvider $localeProvider, ?ElasticInterface $header = null)
    {
        parent::__construct($elastics, $localeProvider);
        $this->header = $header;
    }

    public function render(): string
    {
        return $this->renderView('faqs', [
            'elastics' => $this->elastics,
            'header' => $this->header,
            'locale' => $this->localeProvider->get()->asString(),
        ]);
    }
}
