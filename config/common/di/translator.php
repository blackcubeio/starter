<?php

declare(strict_types=1);

use Blackcube\Dboard\Dboard;
use Yiisoft\Translator\IntlMessageFormatter;
use Yiisoft\Translator\MessageFormatterInterface;

return array_merge([
    MessageFormatterInterface::class => IntlMessageFormatter::class,
], Dboard::getI18nSources());
