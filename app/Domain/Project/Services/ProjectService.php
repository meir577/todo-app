<?php

declare(strict_types=1);

namespace App\Domain\Project\Services;

use App\Domain\Project\Entity\Project;
use App\Domain\Project\Repository\ProjectRepository;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    public function __construct(
        private readonly ProjectRepository $project_repository
    ) {
    }

    public function fetchAllProjects(int $user_id, ?int $project_id): Collection
    {
        return $this->project_repository->selectAll($user_id, $project_id, true);
    }

    public function create(array $task_data): Project
    {
        return $this->project_repository->insert($task_data);
    }

    public function remove(Project $project): Project
    {
        return $this->project_repository->delete($project);
    }

    public function change(Project $project, array $data): Project
    {
        return $this->project_repository->update($project, $data);
    }
}
