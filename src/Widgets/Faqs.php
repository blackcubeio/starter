<?php

declare(strict_types=1);

namespace App\Widgets;

use Blackcube\ActiveRecord\Elastic\ElasticInterface;
use Yiisoft\I18n\LocaleProvider;

final class Faqs extends AbstractGroupWidget
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
