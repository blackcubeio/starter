<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets\Traits;

use App\Widgets\Helpers\ActiveHelper;
use Yiisoft\FormModel\FormModelInterface;
use Yiisoft\Html\Html;
use Yiisoft\Validator\Helper\RulesNormalizer;
use Yiisoft\Validator\Rule\AbstractNumber;
use Yiisoft\Validator\Rule\Email;
use Yiisoft\Validator\Rule\Length;
use Yiisoft\Validator\Rule\Regex;
use Yiisoft\Validator\Rule\Required;
use Yiisoft\Validator\Rule\Url;

/**
 * Binds a form widget to a model property: name, id, value, label, errors and the
 * HTML attributes derived from the validation rules.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
trait ModelAwareTrait
{
    private ?FormModelInterface $model = null;
    private ?string $property = null;

    public function active(FormModelInterface $model, string $property): static
    {
        $new = clone $this;
        $new->model = $model;
        $new->property = $property;
        return $new;
    }

    protected function getModel(): ?FormModelInterface
    {
        return $this->model;
    }

    protected function getProperty(): ?string
    {
        return $this->property;
    }

    protected function getAttributeName(): ?string
    {
        $attributeName = null;
        if ($this->property !== null) {
            $attributeName = ActiveHelper::getAttributeName($this->property);
        }

        return $attributeName;
    }

    protected function getValue(): mixed
    {
        $value = null;
        if ($this->model !== null && $this->property !== null) {
            $value = $this->model->getPropertyValue($this->getAttributeName());
        }

        return $value;
    }

    protected function getLabel(): ?string
    {
        $label = null;
        if ($this->model !== null && $this->property !== null) {
            $label = $this->model->getPropertyLabel($this->getAttributeName());
        }

        return $label;
    }

    protected function getHint(): ?string
    {
        $hint = null;
        if ($this->model !== null && $this->property !== null) {
            $propertyHint = $this->model->getPropertyHint($this->getAttributeName());
            if ($propertyHint !== '') {
                $hint = $propertyHint;
            }
        }

        return $hint;
    }

    protected function getPlaceholder(): ?string
    {
        $placeholder = null;
        if ($this->model !== null && $this->property !== null) {
            $propertyPlaceholder = $this->model->getPropertyPlaceholder($this->getAttributeName());
            if ($propertyPlaceholder !== '') {
                $placeholder = $propertyPlaceholder;
            }
        }

        return $placeholder;
    }

    /**
     * @return list<string>
     */
    protected function getErrors(): array
    {
        $errors = [];
        if ($this->model !== null && $this->property !== null && $this->model->isValidated() === true) {
            $errors = $this->model->getValidationResult()->getPropertyErrorMessages($this->getAttributeName());
        }

        return $errors;
    }

    protected function hasErrors(): bool
    {
        return $this->getErrors() !== [];
    }

    protected function isRequired(): bool
    {
        $required = false;
        if ($this->model !== null && $this->property !== null) {
            $rules = RulesNormalizer::normalize(null, $this->model);
            $propertyRules = $rules[$this->getAttributeName()] ?? [];
            foreach ($propertyRules as $rule) {
                if ($rule instanceof Required) {
                    $required = true;
                }
            }
        }

        return $required;
    }

    /**
     * @return array<string, mixed>
     */
    protected function getInputAttributes(): array
    {
        $attributes = [];
        if ($this->model !== null && $this->property !== null) {
            $rules = RulesNormalizer::normalize(null, $this->model);
            $propertyRules = $rules[$this->getAttributeName()] ?? [];
            foreach ($propertyRules as $rule) {
                $this->enrichAttributesFromRule($rule, $attributes);
            }
        }

        return $attributes;
    }

    /**
     * @param array<string, mixed> $attributes
     */
    private function enrichAttributesFromRule(mixed $rule, array &$attributes): void
    {
        if ($rule instanceof Required) {
            $attributes['required'] = true;
        } elseif ($rule instanceof Length) {
            if (($min = $rule->getMin()) !== null) {
                $attributes['minlength'] = $min;
            }
            if (($max = $rule->getMax()) !== null) {
                $attributes['maxlength'] = $max;
            }
        } elseif ($rule instanceof AbstractNumber) {
            if (($min = $rule->getMin()) !== null) {
                $attributes['min'] = $min;
            }
            if (($max = $rule->getMax()) !== null) {
                $attributes['max'] = $max;
            }
        } elseif ($rule instanceof Regex && $rule->isNot() === false) {
            $attributes['pattern'] = Html::normalizeRegexpPattern($rule->getPattern());
        } elseif ($rule instanceof Email) {
            $attributes['type'] = 'email';
        } elseif ($rule instanceof Url) {
            $attributes['type'] = 'url';
        }
    }

    protected function getInputName(): ?string
    {
        $inputName = null;
        if ($this->model !== null && $this->property !== null) {
            $inputName = ActiveHelper::getInputName($this->model, $this->property);
        }

        return $inputName;
    }

    protected function getInputId(): ?string
    {
        $inputId = null;
        if ($this->model !== null && $this->property !== null) {
            $inputId = ActiveHelper::getInputId($this->model, $this->property);
        }

        return $inputId;
    }

    protected function hasModel(): bool
    {
        return $this->model !== null && $this->property !== null;
    }
}
