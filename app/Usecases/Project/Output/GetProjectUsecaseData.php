<?php

declare(strict_types=1);

namespace App\Usecases\Project\Output;

use Illuminate\Database\Eloquent\Collection;
use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;

class GetProjectUsecaseData implements UsecaseDataInterface
{
    private readonly Collection $data;

    public function setData(Collection $data): void
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        $projects = [];

        foreach ($this->data as $project) {
            $projects[] = [
                'id' => $project->id,
                'name' => $project->name,
                'tasks_count' => $project->tasks_count,
                'user_id' => $project->user_id,
            ];
        }

        return $projects;
    }
}
