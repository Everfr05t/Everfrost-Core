# Everfrost Core

Everfrost Core is the shared domain library of the Everfrost ecosystem.

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

## Requirements

- PHP 8.4+
- Composer 2

## Development

Install dependencies:

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