<?php

declare(strict_types=1);

namespace Everfrost\Core\Capability;

final readonly class CapabilitySet
{
    /**
     * @var array<string, Capability>
     */
    private array $capabilities;

    public function __construct(Capability ...$capabilities)
    {
        $indexedCapabilities = [];
        foreach ($capabilities as $capability) {
            $indexedCapabilities[$capability->value()] = $capability;
        }
        $this->capabilities = $indexedCapabilities;
    }

    public function has(Capability $capability): bool
    {
        return isset($this->capabilities[$capability->value()]);
    }

    public function hasAll(Capability ...$capabilities): bool
    {
        foreach ($capabilities as $capability) {
            if (!$this->has($capability)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return list<Capability>
     */
    public function all(): array
    {
        return array_values($this->capabilities);
    }

    public function isEmpty(): bool
    {
        return $this->capabilities === [];
    }
}
