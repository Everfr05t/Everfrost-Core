<?php

declare(strict_types=1);

namespace Everfrost\Core\Environment;

use InvalidArgumentException;

final readonly class EnvironmentKey
{
    private const string PATTERN = '/^[a-z][a-z0-9-]*$/D';

    public function __construct(private string $value)
    {
        if (preg_match(self::PATTERN, $value) !== 1) {
            throw new InvalidArgumentException(sprintf('Invalid environment key "%s".', $value));
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}
