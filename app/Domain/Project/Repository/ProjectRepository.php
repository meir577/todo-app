<?php

declare(strict_types=1);

namespace App\Domain\Project\Repository;

use App\Domain\Project\Entity\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository
{
    public function insert(array $data): Project
    {
        return Project::create([
            'name'    => $data['name'],
            'user_id' => $data['user_id'],
        ]);
    }

    public function selectAll(int $userId, ?int $projectId, bool $countTasks = false): Collection
    {
        if ($projectId) {
            return Project::withCount('tasks')->where('id', $projectId)->get();
        }

        if ($countTasks) {
            return Project::withCount('tasks')->where('user_id', $userId)->get();
        }

        return Project::where('user_id', $userId)->get();
    }

    public function delete(Project $project): Project
    {
        $project->delete();
        return $project;
    }

    public function update(Project $project, array $data): Project
    {
        $project->update($data);
        return $project;
    }
}
