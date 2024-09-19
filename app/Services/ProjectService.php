<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Project;
use App\Repositories\ProjectRepository;

class ProjectService
{
    public function __construct(
        private readonly ProjectRepository $project_repository
    ) {
    }

    public function fetchAllProjects(int $user_id, ?int $project_id): array
    {
        return $this->project_repository->selectAll($user_id, $project_id, true)->toArray();
    }

    public function create(array $task_data): array
    {
        return $this->project_repository->insert($task_data);
    }

    public function remove(Project $project): ?bool
    {
        return $this->project_repository->delete($project);
    }

    public function change(Project $project, array $data): array
    {
        return $this->project_repository->update($project, $data);
    }
}
