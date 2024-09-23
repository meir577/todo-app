<?php

declare(strict_types=1);

namespace App\Domain\Task\Repository;

use App\Domain\Task\Entity\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository
{
    public function insert(array $data): Task
    {
        return Task::create([
            'name' => $data['name'],
            'project_id' => $data['project_id'],
        ]);
    }

    public function selectAll(array $filter): Collection
    {
        $query = Task::query();

        if (isset($filter['task_id'])) {
            return $query->where('id', $filter['task_id'])->get();
        }

        if (isset($filter['project_id'])) {
            $query->where('project_id', $filter['project_id']);
        }

        if (isset($filter['name'])) {
            $query->where('name', 'like', '%' . $filter['name'] . '%');
        }

        return $query->get();
    }

    public function delete(Task $task): Task
    {
        $task->delete();

        return $task;
    }

    public function update(Task $task, array $data): Task
    {
        $task->update($data);

        return $task;
    }
}
