<?php

declare(strict_types=1);

namespace Everfrost\Core\Tests\Infrastructure;

use Everfrost\Core\Capability\Capability;
use Everfrost\Core\Capability\CapabilitySet;
use Everfrost\Core\Infrastructure\Infrastructure;
use Everfrost\Core\Infrastructure\InfrastructureId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class InfrastructureTest extends TestCase
{
    public function testItStoresItsState(): void
    {
        $id = new InfrastructureId("infra_123");
        $capabilities = new CapabilitySet(new Capability("deploy.files"), new Capability("monitoring.http"));
        $infrastructure = new Infrastructure($id, "OVH Production", $capabilities);

        self::assertSame($id, $infrastructure->id());
        self::assertSame('OVH Production', $infrastructure->name());
        self::assertSame($capabilities, $infrastructure->capabilities());
    }

    public function testItSupportsACapability(): void
    {
        $infrastructure = new Infrastructure(new InfrastructureId("infra_123"), 'Frosthold', new CapabilitySet(new Capability('deploy.docker')));
        self::assertTrue($infrastructure->supports(new Capability('deploy.docker')));
    }

    public function testItDoesNotSupportAnUnknownCapability(): void
    {
        $infrastructure = new Infrastructure(new InfrastructureId('infra_123'), 'OVH Production', new CapabilitySet(new Capability('deploy.files')));
        self::assertFalse($infrastructure->supports(new Capability('deploy.docker')));
    }

    public function testItSupportsAllRequiredCapabilities(): void
    {
        $infrastructure = new Infrastructure(new InfrastructureId('infra_123'), 'Frosthold', new CapabilitySet(new Capability('deploy.docker'), new Capability('services.restart')));
        self::assertTrue($infrastructure->supportsAll(new Capability('deploy.docker'), new Capability('services.restart')));
    }

    public function testItReturnsFalseWhenOneRequiredCapabilityIsMissing(): void
    {
        $infrastructure = new Infrastructure(new InfrastructureId('infra_123'), 'Frosthold', new CapabilitySet(new Capability('deploy.docker')));
        self::assertFalse($infrastructure->supportsAll(new Capability('deploy.docker'), new Capability('services.restart')));
    }

    public function testItRejectsAnEmptyName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Infrastructure(new InfrastructureId('infra_123'), '', new CapabilitySet());
    }

    public function testItRejectsANameContainingOnlyWhitespace(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Infrastructure(new InfrastructureId('infra_123'), '     ', new CapabilitySet());
    }

    public function testItRejectsSurroundingWhitespaceInName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Infrastructure(new InfrastructureId('infra_123'), ' Frosthold ', new CapabilitySet());
    }
}
