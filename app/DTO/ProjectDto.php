<?php

declare(strict_types=1);

namespace App\DTO;

class ProjectDto extends AbstractDto
{
    public function __construct(
        private readonly string $name,
        private readonly ?int   $project_id = null,
    )
    {
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'project_id' => $this->project_id
        ], fn(mixed $value) => $value !== null);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getProjectId(): ?int
    {
        return $this->project_id;
    }
}
