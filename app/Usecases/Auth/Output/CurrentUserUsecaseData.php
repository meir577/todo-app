<?php

namespace App\Usecases\Auth\Output;

use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;

class CurrentUserUsecaseData implements UsecaseDataInterface
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
            'email' => $this->data['email'],
        ];
    }
}
