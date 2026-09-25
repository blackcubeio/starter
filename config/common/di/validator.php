<?php

declare(strict_types=1);

/**
 * validator.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

use Yiisoft\Definitions\DynamicReference;
use Yiisoft\Definitions\Reference;
use Yiisoft\Translator\CategorySource;
use Yiisoft\Translator\Message\Db\MessageSource;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\Validator\Validator;
use Yiisoft\Validator\ValidatorInterface;

/** @var array $params */

return [
    ValidatorInterface::class => [
        'class' => Validator::class,
        '__construct()' => [
            'translator' => Reference::to(TranslatorInterface::class),
            'translationCategory' => $params['yiisoft/validator']['translation.category'],
        ],
    ],
    'yii.validator.categorySource' => [
        'class' => CategorySource::class,
        '__construct()' => [
            'name' => $params['yiisoft/validator']['translation.category'],
            'reader' => DynamicReference::to(MessageSource::class),
        ],
        'tags' => ['translation.categorySource'],
    ],
];
