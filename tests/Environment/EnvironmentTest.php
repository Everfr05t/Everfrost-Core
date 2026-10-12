<?php

declare(strict_types=1);

namespace Everfrost\Core\Tests\Environment;

use Everfrost\Core\Environment\Environment;
use Everfrost\Core\Environment\EnvironmentId;
use Everfrost\Core\Environment\EnvironmentKey;
use Everfrost\Core\Infrastructure\InfrastructureId;
use Everfrost\Core\Project\ProjectId;
use PHPUnit\Framework\TestCase;

final class EnvironmentTest extends TestCase
{
    public function testItStoresItsState(): void
    {
        $id = new EnvironmentId("env_123");
        $projectId = new ProjectId("project_123");
        $key = new EnvironmentKey("production");
        $infrastructureId = new InfrastructureId('infra_123');

        $environment = new Environment($id, $projectId, $key, $infrastructureId);

        self::assertSame($id, $environment->id());
        self::assertSame($projectId, $environment->projectId());
        self::assertSame($key, $environment->key());
        self::assertSame($infrastructureId, $environment->infrastructureId());
    }
}
