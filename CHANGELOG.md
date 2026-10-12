# Changelog

All notable changes to Everfrost Core will be documented in this file.

Everfrost Core follows semantic versioning. Stable releases may also receive a
codename within the Everfrost theme.

## [1.0.0] - Iceheart - 2026-10-12

First stable release of Everfrost Core.

### Added

- `Project` and `ProjectId` domain models.
- `Environment`, `EnvironmentId`, and `EnvironmentKey` domain models.
- `Infrastructure` and `InfrastructureId` domain models.
- `Capability` and `CapabilitySet` domain models.
- Capability-based infrastructure feature detection.
- PHP 8.4+ support.
- PHPUnit test suite.
- PHPStan level 10 static analysis.
- PER-CS coding standards.
- Released under the Mozilla Public License 2.0.

### Architecture

- Infrastructure behavior is modeled through capabilities rather than rigid
  infrastructure types.
- The Core remains independent from deployment, backup, monitoring, adapters,
  agents, persistence, HTTP, and provider-specific implementations.
