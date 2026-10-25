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
 * Label of a form field, bound to a model property.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
class Label
{
    use ModelAwareTrait;

    private string $content = '';
    private string $class = '';
    private bool $encode = true;

    public static function widget(string $content = ''): self
    {
        $new = new self();
        $new->content = $content;
        return $new;
    }

    public function content(string $content): self
    {
        $new = clone $this;
        $new->content = $content;
        return $new;
    }

    public function encode(bool $encode): self
    {
        $new = clone $this;
        $new->encode = $encode;
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
        $for = null;
        $content = $this->content;
        $required = false;

        if ($this->hasModel() === true) {
            $for = $this->getInputId();
            if ($content === '') {
                $label = $this->getLabel();
                if ($label !== null) {
                    $content = $label;
                }
            }
            $required = $this->isRequired();
        }

        $innerHtml = $this->encode === true ? Html::encode($content) : $content;
        if ($required === true) {
            $innerHtml .= Html::tag('span', ' *', ['class' => 'opacity-60'])->encode(false)->render();
        }

        $attributes = [];
        if ($this->class !== '') {
            $attributes['class'] = $this->class;
        }

        return Html::label($innerHtml, $for, $attributes)->encode(false)->render();
    }
}
