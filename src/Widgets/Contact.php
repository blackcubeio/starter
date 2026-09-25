<?php

declare(strict_types=1);

/**
 * Contact.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets;

use App\Forms\ContactForm;
use Blackcube\ActiveRecord\Elastic\ElasticInterface;
use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\Yii\View\Renderer\Csrf;

class Contact extends AbstractWidget
{
    private ?ContactForm $form = null;
    private bool $isSuccess = false;
    private ?Csrf $csrf = null;

    public function __construct(
        ElasticInterface $elastic,
        LocaleProvider $localeProvider,
        private readonly ?TranslatorInterface $translator = null,
    ) {
        parent::__construct($elastic, $localeProvider);
    }

    public function form(?ContactForm $form): self
    {
        $this->form = $form;
        return $this;
    }

    public function success(bool $isSuccess): self
    {
        $this->isSuccess = $isSuccess;
        return $this;
    }

    public function csrf(?Csrf $csrf): self
    {
        $this->csrf = $csrf;
        return $this;
    }

    public function render(): string
    {
        return $this->renderView('contact', [
            'elastic' => $this->elastic,
            'form' => $this->form,
            'isSuccess' => $this->isSuccess,
            'csrf' => $this->csrf,
            'translator' => $this->translator,
        ]);
    }
}
