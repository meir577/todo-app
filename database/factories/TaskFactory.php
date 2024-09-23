<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Task\Entity\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'name' => $this->faker->name(),
            'completed' => $this->faker->numberBetween(0, 1),
            'project_id' => 1,
        ];
    }
}
