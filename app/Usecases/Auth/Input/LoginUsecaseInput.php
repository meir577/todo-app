<?php

declare(strict_types=1);

namespace App\Usecases\Auth\Input;

use App\DTO\CredentialsDto;
use MechtaMarket\PhpEnhance\Base\BaseInput;

class LoginUsecaseInput extends BaseInput
{
    public function __construct(
        private readonly CredentialsDto $data,
    )
    {
    }

    public function getCredentials(): array
    {
        return $this->data->toArray();
    }
}
