<?php

declare(strict_types=1);

namespace App\Widgets;

use Blackcube\Dcore\Entities\Content;
use App\Widgets\Footer\FooterLinks;
use RuntimeException;
use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Widget\Widget;

final class Footer extends AbstractBaseWidget
{
    public function __construct(
        private readonly LocaleProvider $localeProvider,
    ) {
    }

    public function render(): string
    {
        $locale = $this->localeProvider->get()->asString();
        $homeUrl = '/';

        $root = Content::query()
            ->andWhere(['id' => 1])
            ->one();

        if ($root !== null) {
            $langRoot = $root->relativeQuery()
                ->children()
                ->andWhere(['languageId' => $locale])
                ->one();

            if ($langRoot !== null && $langRoot->getSlugId() !== null) {
                $slug = $langRoot->getSlugQuery()->one();
                if ($slug !== null) {
                    $link = $slug->getLink();
                    $homeUrl = $link->isTemplated()
                        ? '/' . ltrim($slug->getPath(), '/')
                        : $link->getHref();
                }
            }
        }

        $footerLinks = FooterLinks::widget()->render();

        return $this->renderView('footer', [
            'footerLinks' => $footerLinks,
            'homeUrl' => $homeUrl,
        ]);
    }
}
