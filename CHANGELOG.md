# Changelog

All notable changes to this project are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2026-07-15

### Changed

- Migrated the underlying HTTP toolkit from [Saloon v3 to v4](https://docs.saloon.dev/upgrade/upgrading-from-v3-to-v4)
  (`saloonphp/saloon` `^3.0` → `^4.0`). None of Saloon v4's breaking changes affect this SDK; the public API and all
  resource/request classes are unchanged.

### Removed

- **BREAKING:** Dropped support for PHP 8.1. The minimum PHP version is now **8.2**, as required by Saloon v4. Consumers
  on PHP 8.1 should stay on `v1.x`.

## [1.2.0] - 2026-07-15

### Added

- Clone and restore actions for resources.
- Per-page pagination.
- Invoice and offer line-item actions.

## [1.1.0] - 2026-07-15

### Added

- Invoice status updates and payments.
- Offer lifecycle actions (send, archive, complete/reopen billing).
- Sending attachments with invoices and offers.

### Changed

- Rebranded from StrawBlond to Blond (blond.swiss) without breaking changes. The `strawblond/strawblond-php-sdk`
  package name and `StrawBlond\` namespace are intentionally retained for backwards compatibility.

## [1.0.0] - 2023-12-14

### Added

- Initial release.

[2.0.0]: https://github.com/strawblond/strawblond-php-sdk/compare/v1.2.0...v2.0.0
[1.2.0]: https://github.com/strawblond/strawblond-php-sdk/compare/v1.1.0...v1.2.0
[1.1.0]: https://github.com/strawblond/strawblond-php-sdk/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/strawblond/strawblond-php-sdk/releases/tag/v1.0.0
