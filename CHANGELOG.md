# Changelog

All notable changes to this project will be documented in this file.

## [1.0.2] - 2026-11-12

### Changed

- The MCP add-on declares itself to dcore: the `'blackcube/dboard' => 'addons'` block and the `Blackcube\Mcp\Migrations` namespace leave `config/common/params.php`. The add-on is activated from the Addons screen of the panel or by `dboard:addonActivate mcp`.
- The migrations of the application are named `M6` + 11 digits. `App\Upgrades\RenameMigrations`, declared in `'blackcube/dcore' => 'upgrades'`, rewrites the history of a base migrated under the former names: `upgrade` runs before `migrate:up`.

## [1.0.1] - 2026-10-27

### Changed

- The application handlers are built on `blackcube/handler`: `Commons\AbstractBaseHandler` extends `Blackcube\Handler\AbstractHandler`, `blackcube/handler` is required.

## [1.0.0] - 2026-10-25

Initial release.
