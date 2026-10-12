<?php

declare(strict_types=1);

namespace Everfrost\Core\Infrastructure;

use InvalidArgumentException;

final readonly class InfrastructureId
{
    public function __construct(private string $value)
    {
        if ($value === "" || trim($value) !== $value) {
            throw new InvalidArgumentException('Infrastructure Identifier must be a non-empty string without surrounding whitespace');
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
