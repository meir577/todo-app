<?php

declare(strict_types=1);

namespace App\DTO;

class CredentialsDto extends AbstractDto
{
    public function __construct(
        private readonly string $email,
        private readonly string $password,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
