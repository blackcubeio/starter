<?php

declare(strict_types=1);

/**
 * AppEnvironment.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App;

use Dotenv\Dotenv;

class AppEnvironment
{
    private static ?self $instance = null;

    private function __construct()
    {
    }

    public static function create(): self
    {
        if (self::$instance === null) {
            Dotenv::createImmutable(dirname(__DIR__))->safeLoad();
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function getName(): ?string
    {
        return $this->getString('APP_NAME');
    }

    public function isDebug(): bool
    {
        return $this->getBool('APP_DEBUG');
    }

    public function isMaintenance(): bool
    {
        return $this->getBool('APP_MAINTENANCE');
    }

    /**
     * @return string[]
     */
    public function getMaintenanceAllowedIps(): array
    {
        return $this->splitList('APP_MAINTENANCE_ALLOWED_IPS');
    }


    /**
     * @return string[]
     */
    public function getTrustedHosts(): array
    {
        return $this->splitList('APP_TRUSTED_HOSTS');
    }


    public function getOauth2PublicKey(): ?string
    {
        return $this->getString('OAUTH2_PUBLIC_KEY');
    }

    public function getOauth2PrivateKey(): ?string
    {
        return $this->getString('OAUTH2_PRIVATE_KEY');
    }


    public function isDbEnabled(): bool
    {
        return $this->getDbUser() !== null
            && $this->getDbPassword() !== null
            && $this->getDbDatabase() !== null;
    }

    public function getDbDsn(): string
    {
        return sprintf('%s:host=%s;dbname=%s;port=%d',
            $this->getDbDriver(),
            $this->getDbHost(),
            $this->getDbDatabase(),
            $this->getDbPort()
        );
    }

    public function getDbDriver(): string
    {
        return $this->getString('DB_DRIVER', 'mysql');
    }

    public function getDbHost(): string
    {
        return $this->getString('DB_HOST', 'localhost');
    }

    public function getDbPort(): int
    {
        return $this->getInt('DB_PORT', 3306);
    }

    public function getDbDatabase(): ?string
    {
        return $this->getString('DB_DATABASE');
    }

    public function getDbUser(): ?string
    {
        return $this->getString('DB_USER');
    }

    public function getDbPassword(): ?string
    {
        return $this->getString('DB_PASSWORD');
    }

    public function getDbTablePrefix(): ?string
    {
        return $this->getString('DB_TABLE_PREFIX');
    }


    public function isCacheEnabled(): bool
    {
        return $this->getBool('CACHE_ENABLED');
    }


    public function isRedisEnabled(): bool
    {
        return $this->getBool('REDIS_ENABLED') && $this->getRedisDatabase() !== null;
    }

    public function getRedisHost(): string
    {
        return $this->getString('REDIS_HOST', 'localhost');
    }

    public function getRedisPort(): int
    {
        return $this->getInt('REDIS_PORT', 6379);
    }

    public function getRedisDatabase(): ?int
    {
        return $this->getInt('REDIS_DATABASE', null);
    }

    public function getRedisPassword(): ?string
    {
        return $this->getString('REDIS_PASSWORD', null);
    }


    public function isMailjetEnabled(): bool
    {
        return $this->getBool('MAILJET_ENABLED');
    }

    public function getMailjetFrom(): ?string
    {
        return $this->getString('MAILJET_FROM');
    }

    public function getMailjetTo(): ?string
    {
        return $this->getString('MAILJET_TO');
    }

    public function getMailjetApiKey(): ?string
    {
        return $this->getString('MAILJET_API_KEY');
    }

    public function getMailjetApiSecret(): ?string
    {
        return $this->getString('MAILJET_API_SECRET');
    }

    public function getFsType(): string
    {
        return $this->getString('FILESYSTEM_TYPE', 'local');
    }
    public function getFsLocalPath(): string
    {
        return $this->getString('FILESYSTEM_LOCAL_PATH');
    }
    public function getFsS3Key(): string
    {
        return $this->getString('FILESYSTEM_S3_KEY');
    }
    public function getFsS3Secret(): string
    {
        return $this->getString('FILESYSTEM_S3_SECRET');
    }
    public function getFsS3Bucket(): string
    {
        return $this->getString('FILESYSTEM_S3_BUCKET');
    }
    public function getFsS3Endpoint(): string
    {
        return $this->getString('FILESYSTEM_S3_ENDPOINT');
    }
    public function getFsS3PathStyle(): bool
    {
        return $this->getBool('FILESYSTEM_S3_PATH_STYLE');
    }
    public function getFsS3Region(): string
    {
        return $this->getString('FILESYSTEM_S3_REGION');
    }
    public function getFsS3Version(): string
    {
        return $this->getString('FILESYSTEM_S3_VERSION');
    }


    public function getTacShowIcon(): bool
    {
        return $this->getBool('TAC_SHOW_ICON', false);
    }
    public function getTacServices(): array
    {
        return $this->splitList('TAC_SERVICES');
    }


    public function getTacMatomoId(): ?string
    {
        return $this->getString('TAC_MATOMO_ID', null);
    }

    public function getTacMatomoHost(): ?string
    {
        return $this->getString('TAC_MATOMO_HOST', null);
    }


    private function getString(string $key, ?string $default = null): ?string
    {
        $value = getenv($key);
        return $value !== false ? $value : ($_SERVER[$key] ?? $_ENV[$key] ?? $default);
    }

    private function getBool(string $key, bool $default = false): bool
    {
        $value = $this->getString($key);
        return $value !== null ? in_array(strtolower($value), ['true', '1', 'yes'], true) : $default;
    }

    private function getInt(string $key, ?int $default = 0): ?int
    {
        $value = $this->getString($key);
        return $value !== null ? (int)$value : $default;
    }

    /**
     * @return string[]
     */
    private function splitList(string $key): array
    {
        $value = $this->getString($key);
        return $value !== null ? preg_split('/\s*,\s*/', $value, -1, PREG_SPLIT_NO_EMPTY) : [];
    }
}
