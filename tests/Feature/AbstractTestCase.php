<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Domain\Project\Entity\Project;
use App\Domain\Task\Entity\Task;
use App\Domain\User\Entity\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
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

    protected function createTask(Project $project, int $count = 1): Task|Collection
    {
        if ($count === 1) {
            return Task::factory()->create([
                'project_id' => $project->id,
            ]);
        }

        return Task::factory($count)->create([
            'project_id' => $project->id,
        ]);
    }
}
