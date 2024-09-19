<?php

declare(strict_types=1);

namespace App\Usecases\Tag\Output;

use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;

class CreateTagToTaskUsecaseData implements UsecaseDataInterface
{
    private readonly array $data;

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'task_id' => $this->data['task_id'],
        ];
    }
}
