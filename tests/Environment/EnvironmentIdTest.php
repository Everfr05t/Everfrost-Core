<?php

declare(strict_types=1);

namespace Everfrost\Core\Tests\Environment;

use Everfrost\Core\Environment\EnvironmentId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class EnvironmentIdTest extends TestCase
{
    public function testItStoresAValidIdentifier(): void
    {
        self::assertSame('env_123', new EnvironmentId("env_123")->value());
    }

    public function testIdentifiersWithTheSameValueAreEqual(): void
    {
        self::assertTrue(new EnvironmentId('env_123')->equals(new EnvironmentId('env_123')));
    }

    public function testIdentifiersWithDifferentValuesAreNotEqual(): void
    {
        self::assertFalse(new EnvironmentId('env_123')->equals(new EnvironmentId('env_456')));
    }

    public function testItRejectAnEmptyIdentifier(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $id = new EnvironmentId('');
    }

    public function testItRejectAnIdentifierContainingOnlyWhitespace(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $id = new EnvironmentId('    ');
    }

    public function testItRejectsSurroundingWhitespace(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $id = new EnvironmentId(' env_123 ');
    }
}
