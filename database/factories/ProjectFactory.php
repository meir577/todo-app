<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition()
    {
        return [
            'id' => 1,
            'name' => $this->faker->name(),
            'user_id' => 1,
        ];
    }
}
