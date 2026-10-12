<?php

declare(strict_types=1);

namespace Everfrost\Core\Environment;

use Everfrost\Core\Infrastructure\InfrastructureId;
use Everfrost\Core\Project\ProjectId;

final readonly class Environment
{
    public function __construct(private EnvironmentId $id, private ProjectId $projectId, private EnvironmentKey $key, private InfrastructureId $infrastructureId) {}

    public function id(): EnvironmentId
    {
        return $this->id;
    }

    public function projectId(): ProjectId
    {
        return $this->projectId;
    }

    public function key(): EnvironmentKey
    {
        return $this->key;
    }

    public function infrastructureId(): InfrastructureId
    {
        return $this->infrastructureId;
    }
}
