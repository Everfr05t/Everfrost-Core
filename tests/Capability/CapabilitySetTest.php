<?php

declare(strict_types=1);

namespace Everfrost\Core\Tests\Capability;

use Everfrost\Core\Capability\Capability;
use Everfrost\Core\Capability\CapabilitySet;
use PHPUnit\Framework\TestCase;

final class CapabilitySetTest extends TestCase
{
    public function testItCanBeEmpty(): void
    {
        $capabilities = new CapabilitySet();
        self::assertTrue($capabilities->isEmpty());
        self::assertSame([], $capabilities->all());
    }

    public function testItContainsACapability(): void
    {
        $capabilities = new CapabilitySet(new Capability("deploy.files"));
        self::assertTrue($capabilities->has(new Capability("deploy.files")));
    }

    public function testItDoesNotContainAnUnkownCapability(): void
    {
        $capabilities = new CapabilitySet(new Capability("deploy.files"));
        self::assertFalse($capabilities->has(new Capability("deploy.docker")));
    }

    public function testItChecksThatAllCapabilitiesArePresent(): void
    {
        $capabilities = new CapabilitySet(new Capability("deploy.files"), new Capability("deploy.git"), new Capability("monitoring.http"));
        self::assertTrue($capabilities->hasAll(new Capability("deploy.files"), new Capability("deploy.git")));
    }

    public function testHasAllReturnsFalseWhenOneCapabilityIsMissing(): void
    {
        $capabilities = new CapabilitySet(new Capability("deploy.files"));
        self::assertFalse($capabilities->hasAll(new Capability("deploy.files"), new Capability("deploy.docker")));
    }

    public function testItRemovesDuplicateCapabilities(): void
    {
        $capabilities = new CapabilitySet(new Capability("deploy.files"), new Capability("deploy.files"));
        self::assertCount(1, $capabilities->all());
    }

    public function testItReturnsAllCapabilities(): void
    {
        $deployFiles = new Capability("deploy.files");
        $monitoringHttp = new Capability("monitoring.http");

        $capabilities = new CapabilitySet($deployFiles, $monitoringHttp);
        self::assertSame([$deployFiles, $monitoringHttp], $capabilities->all());
    }

    public function testNonEmptySetIsNotEmpty(): void
    {
        $capabilities = new CapabilitySet(new Capability("deploy.files"));
        self::assertFalse($capabilities->isEmpty());
    }
}
