<?php

declare(strict_types=1);

namespace Everfrost\Core\Tests\Project;

use Everfrost\Core\Project\ProjectId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ProjectIdTest extends TestCase
{
    public function testItStoresAValidIdentifier(): void
    {
        $id = new ProjectId("project_123");
        self::assertSame("project_123", $id->value());
    }

    public function testIdentifiersWithTheSameValueAreEqual(): void
    {
        self::assertTrue((new ProjectId("project_123"))->equals(new ProjectId("project_123")));
    }

    public function testIdentifiersWithDifferentValuesAreNotEqual(): void
    {
        self::assertFalse((new ProjectId("project_123"))->equals(new ProjectId("project_456")));
    }

    public function testItRejectsAnEmptyIdentifier(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ProjectId("");
    }

    public function testItRejectsAnIdentifierContainingOnlyWhitespaces(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ProjectId("    ");
    }

    public function testItRejectsSurroundingWhitespace(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ProjectId(" project_123 ");
    }
}
