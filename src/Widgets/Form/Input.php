<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets\Form;

use App\Widgets\Traits\ModelAwareTrait;
use Yiisoft\Html\Html;

/**
 * Input of a form field, bound to a model property.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
class Input
{
    use ModelAwareTrait;

    private string $type = 'text';
    private ?string $autocomplete = null;
    private ?string $placeholder = null;
    private string $class = '';
    private bool $required = false;

    public static function widget(): self
    {
        return new self();
    }

    public function text(): self
    {
        $new = clone $this;
        $new->type = 'text';
        return $new;
    }

    public function email(): self
    {
        $new = clone $this;
        $new->type = 'email';
        return $new;
    }

    public function password(): self
    {
        $new = clone $this;
        $new->type = 'password';
        return $new;
    }

    public function hidden(): self
    {
        $new = clone $this;
        $new->type = 'hidden';
        return $new;
    }

    public function autocomplete(string $value): self
    {
        $new = clone $this;
        $new->autocomplete = $value;
        return $new;
    }

    public function placeholder(string $value): self
    {
        $new = clone $this;
        $new->placeholder = $value;
        return $new;
    }

    public function required(bool $required = true): self
    {
        $new = clone $this;
        $new->required = $required;
        return $new;
    }

    public function addClass(string $class): self
    {
        $new = clone $this;
        $new->class = trim($new->class.' '.$class);
        return $new;
    }

    public function render(): string
    {
        $type = $this->type;
        $name = null;
        $value = null;
        $attributes = [];

        if ($this->hasModel() === true) {
            $name = $this->getInputName();
            $value = $this->getValue();
            $attributes['id'] = $this->getInputId();
            $ruleAttributes = $this->getInputAttributes();
            if (isset($ruleAttributes['type']) === true) {
                $type = $ruleAttributes['type'];
                unset($ruleAttributes['type']);
            }
            $attributes = array_merge($attributes, $ruleAttributes);
        }
        if ($this->autocomplete !== null) {
            $attributes['autocomplete'] = $this->autocomplete;
        }
        if ($this->placeholder !== null) {
            $attributes['placeholder'] = $this->placeholder;
        }
        if ($this->required === true) {
            $attributes['required'] = true;
        }
        if ($this->class !== '') {
            $attributes['class'] = $this->class;
        }

        return Html::input($type, $name, $value === null ? null : (string) $value, $attributes)->render();
    }
}
