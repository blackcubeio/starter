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
 * Textarea of a form field, bound to a model property.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
class Textarea
{
    use ModelAwareTrait;

    private ?string $placeholder = null;
    private ?int $rows = null;
    private string $class = '';
    private bool $required = false;

    public static function widget(): self
    {
        return new self();
    }

    public function placeholder(string $value): self
    {
        $new = clone $this;
        $new->placeholder = $value;
        return $new;
    }

    public function rows(int $rows): self
    {
        $new = clone $this;
        $new->rows = $rows;
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
        $name = null;
        $value = null;
        $attributes = [];

        if ($this->hasModel() === true) {
            $name = $this->getInputName();
            $value = $this->getValue();
            $attributes['id'] = $this->getInputId();
            $attributes = array_merge($attributes, $this->getInputAttributes());
        }
        if ($this->placeholder !== null) {
            $attributes['placeholder'] = $this->placeholder;
        }
        if ($this->rows !== null) {
            $attributes['rows'] = $this->rows;
        }
        if ($this->required === true) {
            $attributes['required'] = true;
        }
        if ($this->class !== '') {
            $attributes['class'] = $this->class;
        }

        return Html::textarea($name, $value === null ? null : (string) $value, $attributes)->render();
    }
}
