<?php

declare(strict_types=1);

/**
 * ContactForm.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Forms;

use Blackcube\BridgeModel\BridgeFormModel;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\Validator\PropertyTranslator\ArrayPropertyTranslator;
use Yiisoft\Validator\PropertyTranslatorInterface;
use Yiisoft\Validator\PropertyTranslatorProviderInterface;
use Yiisoft\Validator\Rule\Email;
use Yiisoft\Validator\Rule\Length;
use Yiisoft\Validator\Rule\Required;

class ContactForm extends BridgeFormModel implements PropertyTranslatorProviderInterface
{
    public const SCENARIO_SUBMIT = 'submit';

    protected ?string $translateCategory = 'app-contact';

    private ?array $translatedLabels = null;

    protected ?string $name = null;
    protected ?string $email = null;
    protected ?string $company = null;
    protected ?string $message = null;

    public function __construct(
        protected ?TranslatorInterface $translator = null,
    ) {
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setCompany(?string $company): void
    {
        $this->company = $company;
    }
    public function getCompany(): ?string
    {
        return $this->company;
    }
    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }
    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function scenarios(): array
    {
        return [
            self::SCENARIO_SUBMIT => ['name', 'email', 'company', 'message'],
        ];
    }

    public function rules(): array
    {
        return [
            'name' => [new Required(), new Length(max: 255, skipOnEmpty: true)],
            'email' => [new Required(), new Email(skipOnEmpty: true), new Length(max: 255, skipOnEmpty: true)],
            'company' => [new Length(max: 255, skipOnEmpty: true)],
            'message' => [new Required(), new Length(max: 65535, skipOnEmpty: true)],
        ];
    }

    public function getPropertyLabels(): array
    {
        if ($this->translatedLabels === null) {
            $this->translatedLabels = $this->translateCategory !== null
                ? $this->translateValues($this->getRawLabels(), $this->translateCategory)
                : $this->getRawLabels();
        }
        return $this->translatedLabels;
    }

    public function getPropertyLabel(string $property): string
    {
        $labels = $this->getPropertyLabels();
        return $labels[$property] ?? parent::getPropertyLabel($property);
    }

    public function getPropertyTranslator(): ?PropertyTranslatorInterface
    {
        return new ArrayPropertyTranslator($this->getPropertyLabels());
    }

    protected function getRawLabels(): array
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'company' => 'Company',
            'message' => 'Message',
        ];
    }

    private function translateValues(array $values, string $category): array
    {
        $translated = [];
        foreach ($values as $prop => $value) {
            $translated[$prop] = $this->translator?->translate($value, category: $category) ?? $value;
        }
        return $translated;
    }
}
