<?php

declare(strict_types=1);

namespace App\DTO;

class TaskDto extends AbstractDto
{
    public function __construct(
        private readonly ?string $name,
        private readonly ?bool   $completed,
        private readonly ?int    $project_id,
    )
    {
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getCompleted(): ?bool
    {
        return $this->completed;
    }

    public function getProjectId(): ?int
    {
        return $this->project_id;
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'completed' => $this->completed,
            'project_id' => $this->project_id
        ], fn(mixed $value) => $value !== null);
    }
}
