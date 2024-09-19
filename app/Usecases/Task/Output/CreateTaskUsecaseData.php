<?php

declare(strict_types=1);

namespace App\Usecases\Task\Output;

use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;

class CreateTaskUsecaseData implements UsecaseDataInterface
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
            'project_id' => $this->data['project_id'],
        ];
    }
}
