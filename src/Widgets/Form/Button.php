<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets\Form;

use Yiisoft\Html\Html;

/**
 * Button of a form.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
class Button
{
    private string $content = '';
    private string $type = 'button';
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

    public function submit(): self
    {
        $new = clone $this;
        $new->type = 'submit';
        return $new;
    }

    public function reset(): self
    {
        $new = clone $this;
        $new->type = 'reset';
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
        $attributes = ['type' => $this->type];
        if ($this->class !== '') {
            $attributes['class'] = $this->class;
        }

        return Html::button($this->content, $attributes)->encode($this->encode)->render();
    }
}
