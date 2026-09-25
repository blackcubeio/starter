<?php

declare(strict_types=1);

/**
 * translator.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

use Blackcube\Dboard\Dboard;
use Yiisoft\Translator\IntlMessageFormatter;
use Yiisoft\Translator\MessageFormatterInterface;

return array_merge([
    MessageFormatterInterface::class => IntlMessageFormatter::class,
], Dboard::getI18nSources());
