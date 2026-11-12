<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Upgrades;

use App\Migrations\M600000000001SeedAppValidatorsTranslations;
use App\Migrations\M600000000002SeedAppContactTranslations;
use Blackcube\Dcore\Upgrades\MigrationRenameUpgrade;

/**
 * The migrations of the application took the type digit 6 (M6 + 11 digits): a base migrated
 * under the former 14-digit names gets its history rewritten.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
class RenameMigrations extends MigrationRenameUpgrade
{
    protected function getRenames(): array
    {
        return [
            'App\\Migrations\\M00000001000001SeedAppValidatorsTranslations' => M600000000001SeedAppValidatorsTranslations::class,
            'App\\Migrations\\M00000001000002SeedAppContactTranslations' => M600000000002SeedAppContactTranslations::class,
        ];
    }
}
