<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Support\LazyCollection;

class ProjectRepository
{
    public function insert(array $data): array
    {
        return Project::create([
            'name'    => $data['name'],
            'user_id' => $data['user_id'],
        ])->toArray();
    }

    public function selectAll(int $userId, ?int $projectId, bool $countTasks = false): LazyCollection
    {
        if ($projectId) {
            return Project::withCount('tasks')->where('id', $projectId)->lazy();
        }

        if ($countTasks) {
            return Project::withCount('tasks')->where('user_id', $userId)->lazy();
        }

        return Project::where('user_id', $userId)->lazy();
    }

    public function delete(Project $project): ?bool
    {
        return $project->delete();
    }

    public function update(Project $project, array $data): array
    {
        $project->update($data);
        return $project->toArray();
    }
}
