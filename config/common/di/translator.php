<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

use Blackcube\Dboard\Dboard;
use Yiisoft\Definitions\DynamicReference;
use Yiisoft\Translator\CategorySource;
use Yiisoft\Translator\IntlMessageFormatter;
use Yiisoft\Translator\Message\Db\MessageSource;
use Yiisoft\Translator\MessageFormatterInterface;

$appSources = [];
foreach (glob(dirname(__DIR__, 3).'/src/i18n/en/*.php') as $file) {
    $category = pathinfo($file, PATHINFO_FILENAME);
    if ($category === 'app-validators') {
        continue;
    }
    $appSources['translation.'.$category] = [
        'class' => CategorySource::class,
        '__construct()' => [
            'name' => $category,
            'reader' => DynamicReference::to(MessageSource::class),
        ],
        'tags' => ['translation.categorySource'],
    ];
}

return array_merge([
    MessageFormatterInterface::class => IntlMessageFormatter::class,
], Dboard::getI18nSources(), $appSources);
