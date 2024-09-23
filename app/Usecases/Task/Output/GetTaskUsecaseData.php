<?php

declare(strict_types=1);

namespace App\Usecases\Task\Output;

use Illuminate\Database\Eloquent\Collection;
use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;

class GetTaskUsecaseData implements UsecaseDataInterface
{
    private readonly Collection $data;

    public function setData(Collection $data): void
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        $tasks = [];

        foreach ($this->data as $task) {
            $tasks[] = [
                'id' => $task->id,
                'name' => $task->name,
                'completed' => $task->completed,
                'tags' => $task->tags->toArray(),
                'project_id' => $task->project_id,
            ];
        }

        return $tasks;
    }
}
