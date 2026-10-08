<?php

declare(strict_types=1);

namespace Everfrost\Core\Tests\Infrastructure;

use Everfrost\Core\Infrastructure\InfrastructureId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class InfrastructureIdTest extends TestCase
{
    public function testItStoresAValidIdentifier(): void
    {
        $id = new InfrastructureId("infra_123");
        self::assertSame("infra_123", $id->value());
    }

    public function testIdentifiersWithTheSameValueAreEqual(): void
    {
        $id = new InfrastructureId("infra_123");
        $other = new InfrastructureId("infra_123");
        self::assertTrue($id->equals($other));
    }

    public function testIdentifiersWithDifferentValuesAreNotEqual(): void
    {
        $id = new InfrastructureId("infra_123");
        $other = new InfrastructureId("infra_456");
        self::assertFalse($id->equals($other));
    }

    public function testItRejectsAnEmptyIdentifier(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new InfrastructureId("");
    }

    public function testItRejectsAnIdentifierContainingOnlyWhitespace(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new InfrastructureId("     ");
    }

    public function testItRejectsSurroundingWhitespace(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new InfrastructureId(" infra_123 ");
    }
}
