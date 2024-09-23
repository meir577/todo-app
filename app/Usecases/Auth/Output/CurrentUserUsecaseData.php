<?php

namespace App\Usecases\Auth\Output;

use App\Domain\User\Entity\User;
use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;

class CurrentUserUsecaseData implements UsecaseDataInterface
{
    private readonly User $data;

    public function setData(User $data): void
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return [
            'id' => $this->data->id,
            'name' => $this->data->name,
            'email' => $this->data->email,
        ];
    }
}
