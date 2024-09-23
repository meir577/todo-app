<?php

declare(strict_types=1);

namespace App\Domain\Task\Services;

use App\Domain\Task\Entity\Task;
use App\Domain\Task\Repository\TaskRepository;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    public function __construct(
        private readonly TaskRepository $task_repository,
    )
    {
    }

    public function fetchTasks(array $filter): Collection
    {
        return $this->task_repository->selectAll($filter);
    }

    public function create(array $data): Task
    {
        return $this->task_repository->insert($data);
    }

    public function remove(Task $task): Task
    {
        return $this->task_repository->delete($task);
    }

    public function change(Task $task, array $data): Task
    {
        return $this->task_repository->update($task, $data);
    }
}
