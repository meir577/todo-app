<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskService
{
    public function __construct(
        private readonly TaskRepository $task_repository,
    )
    {
    }

    public function fetchTasks(array $filter): array
    {
        return $this->task_repository->selectAll($filter)->toArray();
    }

    public function create(array $data): array
    {
        return $this->task_repository->insert($data)->toArray();
    }

    public function remove(Task $task): void
    {
        $this->task_repository->delete($task);
    }

    public function change(Task $task, array $data): array
    {
        return $this->task_repository->update($task, $data)->toArray();
    }
}
