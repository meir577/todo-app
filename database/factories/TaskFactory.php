<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
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
