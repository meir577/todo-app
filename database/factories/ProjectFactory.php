<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Project\Entity\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'id' => 1,
            'name' => $this->faker->name(),
            'user_id' => 1,
        ];
    }
}
