<?php

declare(strict_types=1);

namespace Everfrost\Core\Tests\Project;

use Everfrost\Core\Project\Project;
use Everfrost\Core\Project\ProjectId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ProjectTest extends TestCase
{
    public function testItStoresItsState(): void
    {
        $id = new ProjectId('project_123');
        $project = new Project($id, "Amazing USA Canada");

        self::assertSame($id, $project->id());
        self::assertSame("Amazing USA Canada", $project->name());
    }

    public function testItRejectsAnEmptyName(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Project(new ProjectId("project_123"), "");
    }

    public function testItRejectsANameContainingOnlyWhitespace(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Project(new ProjectId("project_123"), "    ");
    }

    public function testItRejectsSurroundingWhitespace(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Project(new ProjectId("project_123"), " Amazing USA Canada ");
    }
}
