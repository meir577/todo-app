<?php

declare(strict_types=1);

namespace App\Usecases\Task\Output;

use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;

class GetTaskUsecaseData implements UsecaseDataInterface
{
    private readonly array $data;

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        $tasks = [];

        foreach ($this->data as $task) {
            $tasks[] = [
                'id' => $task['id'],
                'name' => $task['name'],
                'completed' => $task['completed'],
                'project_id' => $task['project_id'],
                'tags' => $task['tags'],
            ];
        }

        return $tasks;
    }
}
