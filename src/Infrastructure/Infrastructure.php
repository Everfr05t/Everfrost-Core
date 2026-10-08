<?php

declare(strict_types=1);

namespace Everfrost\Core\Infrastructure;

use Everfrost\Core\Capability\Capability;
use Everfrost\Core\Capability\CapabilitySet;
use InvalidArgumentException;

final readonly class Infrastructure
{
    public function __construct(private InfrastructureId $id, private string $name, private CapabilitySet $capabilities)
    {
        if ($name === '' || trim($name) !== $name) {
            throw new InvalidArgumentException("Infrastructure name must be a non-empty string without surrounding whitespace.");
        }
    }

    public function id(): InfrastructureId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function capabilities(): CapabilitySet
    {
        return $this->capabilities;
    }

    public function supports(Capability $capability): bool
    {
        return $this->capabilities->has($capability);
    }

    public function supportsAll(Capability ...$capabilities): bool
    {
        return $this->capabilities->hasAll(...$capabilities);
    }
}
