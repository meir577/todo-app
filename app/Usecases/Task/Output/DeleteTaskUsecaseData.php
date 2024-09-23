<?php

declare(strict_types=1);

namespace App\Usecases\Task\Output;

use App\Domain\Task\Entity\Task;
use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;

class DeleteTaskUsecaseData implements UsecaseDataInterface
{
    private readonly Task $data;

    public function setData(Task $data): void
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return [
            'id' => $this->data->id,
            'name' => $this->data->name,
            'completed' => $this->data->completed,
            'tags' => $this->data->tags->toArray(),
            'project_id' => $this->data->project_id,
        ];
    }
}
