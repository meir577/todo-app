<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function insert(array $data): Task
    {
        return Task::create([
            'name' => $data['name'],
            'project_id' => $data['project_id'],
        ]);
    }

    public function selectAll(array $filter): mixed
    {
        $query = Task::query();

        if (isset($filter['taskId'])) {
            return $query->where('id', $filter['taskId'])->first();
        }

        if (isset($filter['projectId'])) {
            $query->where('project_id', $filter['projectId']);
        }

        if (isset($filter['name'])) {
            $query->where('name', 'like', '%' . $filter['name'] . '%');
        }

        return $query->lazy();
    }

    public function delete(Task $task): ?bool
    {
        return $task->delete();
    }

    public function update(Task $task, array $data): Task
    {
        $task->update($data);
        return $task;
    }
}
