<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets\Helpers;

use Yiisoft\FormModel\FormModelInterface;

/**
 * Input name, input id and attribute name of a model property, following the form
 * model naming.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
class ActiveHelper
{
    private const ATTRIBUTE_REGEX = '/(^|.*\])([\w\.\+]+)(\[.*|$)/u';

    public static function getInputName(FormModelInterface $model, string $attribute): string
    {
        $formName = $model->getFormName();

        if (preg_match(self::ATTRIBUTE_REGEX, $attribute, $matches) !== 1) {
            if ($formName === '') {
                $inputName = $attribute;
            } else {
                $inputName = $formName.'['.$attribute.']';
            }
        } else {
            $prefix = $matches[1];
            $attributeName = $matches[2];
            $suffix = $matches[3];

            if ($formName === '' && $prefix === '') {
                $inputName = $attributeName.$suffix;
            } elseif ($formName !== '') {
                $inputName = $formName.$prefix.'['.$attributeName.']'.$suffix;
            } else {
                $inputName = $prefix.'['.$attributeName.']'.$suffix;
            }
        }

        return $inputName;
    }

    public static function getInputId(FormModelInterface $model, string $attribute): string
    {
        $name = self::getInputName($model, $attribute);
        return self::nameToId($name);
    }

    public static function nameToId(string $name): string
    {
        $name = mb_strtolower($name);
        $search = [
            '[]',
            '][',
            '[',
            ']',
            ' ',
            '.',
            '--',
        ];
        $replace = [
            '',
            '-',
            '-',
            '',
            '-',
            '-',
            '-',
        ];
        return str_replace($search, $replace, $name);
    }

    public static function getAttributeName(string $attribute): string
    {
        $attributeName = $attribute;
        if (preg_match(self::ATTRIBUTE_REGEX, $attribute, $matches) === 1) {
            $attributeName = $matches[2];
        }

        return $attributeName;
    }
}
