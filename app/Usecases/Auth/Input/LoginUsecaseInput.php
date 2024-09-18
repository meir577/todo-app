<?php

declare(strict_types=1);

namespace App\Usecases\Auth\Input;

use MechtaMarket\PhpEnhance\Base\BaseInput;

class LoginUsecaseInput extends BaseInput
{
    public function __construct(
        private readonly array $data,
    )
    {
    }

    public function getCredentials(): array
    {
        return $this->data;
    }
}
