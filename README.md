# Everfrost Core

Everfrost Core is the shared domain library of the Everfrost ecosystem.

> Current stable release: **v1.0.0 — Iceheart**

It provides the fundamental domain models, value objects, invariants and
contracts used by Everfrost components.

## Scope

Everfrost Core currently models:

- Projects
- Environments
- Infrastructures
- Capabilities

## Non-goals

Everfrost Core does not implement:

- deployment
- backups
- monitoring
- infrastructure adapters
- infrastructure agents
- persistence
- HTTP APIs
- authentication
- billing
- client-specific business logic

Infrastructure-specific operations belong to adapters and agents.

Application orchestration belongs to Everfrost Platform.

## Releases

Everfrost Core follows semantic versioning.

The first stable release is **v1.0.0 — Iceheart**. Iceheart establishes the
initial public domain API that will serve as the foundation of the Everfrost
ecosystem.

See [CHANGELOG.md](CHANGELOG.md) for release history.

## License

Everfrost Core is licensed under the Mozilla Public License 2.0.

See [LICENSE](LICENSE) for details.

## Requirements

- PHP 8.4+
- Composer 2

## Development

Install dependencies:

```bash
composer install
```

Run tests:

```bash
composer test
```

Run static analysis:

```bash
composer analyse
```

Check coding standards:

```bash
composer lint
```

Run all checks:

```bash
composer check
```

Automatically fix coding-style issues:

```bash
composer fix
```
