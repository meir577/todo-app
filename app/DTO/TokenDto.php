<?php

declare(strict_types=1);

namespace App\DTO;

class TokenDto extends AbstractDto
{
    public function __construct(
        private readonly string $token,
        private readonly string $expires_at
    )
    {
    }

    public function toArray(): array
    {
        return [
            'token' => $this->token,
            'expires_at' => $this->expires_at,
        ];
    }
}
