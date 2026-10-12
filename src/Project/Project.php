<?php

declare(strict_types=1);

namespace Everfrost\Core\Project;

use InvalidArgumentException;

final readonly class Project
{
    public function __construct(private ProjectId $id, private string $name)
    {
        if ($name === "" || trim($name) !== $name) {
            throw new InvalidArgumentException('Project name must be a non-empty string without surrounding whitespace.');
        }
    }

    public function id(): ProjectId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
