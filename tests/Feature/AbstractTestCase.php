<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Iterator;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AbstractTestCase extends TestCase
{
    protected function login(): Authenticatable
    {
        return Sanctum::actingAs(User::factory()->create());
    }

    protected function createProject(Authenticatable $user): Project
    {
        return Project::factory()->create([
            'user_id' => $user->id
        ]);
    }

    protected function createTask(Project $project, int $task_id = 1): Task
    {
        return Task::factory()->create([
            'id' => $task_id,
            'project_id' => $project->id,
        ]);
    }
}
