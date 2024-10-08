<?php

namespace App\Usecases\Auth\Output;

use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;

class LoginUsecaseData implements UsecaseDataInterface
{
    private readonly array $data;

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
