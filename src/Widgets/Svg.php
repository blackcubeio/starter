<?php

declare(strict_types=1);

/**
 * Svg.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Widgets;

use InvalidArgumentException;
use Yiisoft\Html\Html;

/**
 * SVG widget for Heroicons and site-specific logos.
 *
 * Usage:
 *   Svg::logo('blackcube')->addClass('h-9 w-9')->render();
 *   Svg::icon('chevron-down')->addClass('w-5 h-5')->render();
 *
 * Registries:
 *   - Heroicons outline 24x24 (Svg::icon)  → resources/heroicons/normal/outline.php
 *   - Custom logos             (Svg::logo) → resources/customicons/logo/solid.php
 */
class Svg
{
    private const KIND_LOGO = 'logo';
    private const KIND_ICON = 'icon';

    private const RESOURCES_DIR = __DIR__.'/../Assets/Static/Icons';

    /** @var array<string, array<string, array<string|int, string>>> */
    private static array $loadedRegistries = [];

    private array $attributes = [];

    private function __construct(
        private readonly string $kind,
        private readonly string $name,
    ) {
    }

    public static function logo(string $name): self
    {
        return new self(self::KIND_LOGO, $name);
    }

    public static function icon(string $name): self
    {
        return new self(self::KIND_ICON, $name);
    }

    public function addClass(string ...$classes): self
    {
        $existing = $this->attributes['class'] ?? '';
        $this->attributes['class'] = trim($existing.' '.implode(' ', $classes));
        return $this;
    }

    public function id(string $id): self
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function attribute(string $name, mixed $value): self
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    public function attributes(array $attributes): self
    {
        $this->attributes = array_merge($this->attributes, $attributes);
        return $this;
    }

    public function render(): string
    {
        $data = $this->getData();

        $baseAttributes = match ($this->kind) {
            self::KIND_LOGO => [
                'xmlns' => 'http://www.w3.org/2000/svg',
                'fill' => 'none',
                'aria-hidden' => 'true',
            ],
            self::KIND_ICON => [
                'xmlns' => 'http://www.w3.org/2000/svg',
                'fill' => 'none',
                'stroke' => 'currentColor',
                'stroke-width' => '1.5',
                'aria-hidden' => 'true',
            ],
        };

        $baseAttributes['viewBox'] = $data['viewBox'] ?? '0 0 24 24';

        $paths = '';
        foreach ($data as $key => $value) {
            if (is_int($key) === true) {
                $paths .= $value;
            }
        }

        $finalAttributes = array_merge($baseAttributes, $this->attributes);

        return Html::tag('svg', $paths, $finalAttributes)->encode(false)->render();
    }

    /**
     * @return array<string|int, string>
     */
    private function getData(): array
    {
        $filePath = match ($this->kind) {
            self::KIND_LOGO => self::RESOURCES_DIR.'/customicons/logo/solid.php',
            self::KIND_ICON => self::RESOURCES_DIR.'/heroicons/normal/outline.php',
            default => throw new InvalidArgumentException('Unknown SVG kind: '.$this->kind),
        };

        if (isset(self::$loadedRegistries[$filePath]) === false) {
            if (file_exists($filePath) === false) {
                throw new InvalidArgumentException('Icon registry not found: '.$filePath);
            }
            self::$loadedRegistries[$filePath] = require $filePath;
        }

        $registry = self::$loadedRegistries[$filePath];

        if (isset($registry[$this->name]) === false) {
            throw new InvalidArgumentException('Unknown SVG '.$this->kind.' "'.$this->name.'"');
        }

        return $registry[$this->name];
    }
}
