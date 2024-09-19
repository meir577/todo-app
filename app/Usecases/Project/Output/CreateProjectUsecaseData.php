<?php

declare(strict_types=1);

namespace App\Usecases\Project\Output;

use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;

class CreateProjectUsecaseData implements UsecaseDataInterface
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
            'user_id' => $this->data['user_id'],
        ];
    }
}
