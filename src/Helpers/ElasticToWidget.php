<?php

declare(strict_types=1);

/**
 * ElasticToWidget.php
 *
 * PHP Version 8.3+
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Helpers;

use Blackcube\ActiveRecord\Elastic\ElasticInterface;
use Blackcube\Dcore\Entities\ElasticSchema;
use App\Widgets\AbstractGroupWidget;
use App\Widgets\AbstractWidget;
use App\Widgets\Callout;
use App\Widgets\Code;
use App\Widgets\Contact;
use App\Widgets\Content;
use App\Widgets\Cta;
use App\Widgets\Error;
use App\Widgets\Faq;
use App\Widgets\Faqs;
use App\Widgets\Feature;
use App\Widgets\Features;
use App\Widgets\Hero;
use App\Widgets\Image;
use App\Widgets\Images;
use App\Widgets\Media;
use App\Widgets\Section;
use App\Widgets\Stat;
use App\Widgets\Stats;

class ElasticToWidget
{
    private const WIDGET_MAP = [
        'hero' => Hero::class,
        'section' => Section::class,
        'content' => Content::class,
        'code' => Code::class,
        'callout' => Callout::class,
        'image' => Image::class,
        'media' => Media::class,
        'faq' => Faq::class,
        'cta' => Cta::class,
        'contact' => Contact::class,
        'feature' => Feature::class,
        'stat' => Stat::class,
        'error' => Error::class,
    ];

    private const GROUP_MAP = [
        'feature' => Features::class,
        'image' => Images::class,
        'stat' => Stats::class,
        'faq' => Faqs::class,
    ];

    public static function getSchemaName(ElasticInterface $elastic): ?string
    {
        try {
            $elasticId = $elastic->getElasticSchemaId();
            $elasticSchema = ElasticSchema::query()->andWhere([
                'id' => $elasticId,
            ])->one();
            return strtolower($elasticSchema->getName());
        } catch (\Throwable $e) {
            return null;
        }
    }

    public static function convert(ElasticInterface $elastic): ?AbstractWidget
    {
        $widget = null;
        $schemaName = self::getSchemaName($elastic);
        if ($schemaName !== null && isset(self::WIDGET_MAP[$schemaName])) {

            $class = self::WIDGET_MAP[$schemaName];
            $widget = $class::widget(['elastic' => $elastic]);
        }
        return $widget;
    }

    /**
     * @param ElasticInterface[] $items
     */
    public static function convertGroup(array $items, ?ElasticInterface $header = null): ?AbstractGroupWidget
    {
        $result = null;
        $schemaName = self::getSchemaName($items[0]);
        if (empty($items) === false && $schemaName !== null && isset(self::GROUP_MAP[$schemaName])) {
            $class = self::GROUP_MAP[$schemaName];
            if ($class === Faqs::class) {
                $result = $class::widget(['elastics' => $items, 'header' => $header]);
            } else {
                $result = $class::widget(['elastics' => $items]);
            }
        }
        return $result;

    }

    /**
     * @return array<AbstractWidget|AbstractGroupWidget>
     */
    public static function convertAll($blocsquery): array
    {
        $allBlocs = [];
        foreach ($blocsquery->each() as $bloc) {
            $allBlocs[] = $bloc;
        }

        $merged = MergeBlocs::merge($allBlocs);
        $widgets = [];

        foreach ($merged as $item) {
            if (is_array($item)) {
                $schemaName = self::getSchemaName($item[0]);
                $header = null;

                if ($schemaName === 'faq' && $widgets !== []) {
                    $lastKey = array_key_last($widgets);
                    $lastWidget = $widgets[$lastKey];
                    if ($lastWidget instanceof Section) {
                        $header = $lastWidget->getElastic();
                        unset($widgets[$lastKey]);
                        $widgets = array_values($widgets);
                    }
                }

                $widget = self::convertGroup($item, $header);
            } else {
                $widget = self::convert($item);
            }
            if ($widget !== null) {
                $widgets[] = $widget;
            }
        }

        return $widgets;
    }
}
