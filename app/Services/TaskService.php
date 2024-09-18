<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskService
{
    public function __construct(
        private readonly TaskRepository $taskRepository,
    )
    {
    }

    public function fetchTasks(array $filter): array
    {
        return $this->taskRepository->selectAll($filter)->toArray();
    }

    public function create(array $data): array
    {
        return $this->taskRepository->insert($data)->toArray();
    }

    public function remove(Task $task): void
    {
        $this->taskRepository->delete($task);
    }

    public function change(Task $task, array $data): array
    {
        return $this->taskRepository->update($task, $data)->toArray();
    }
}
