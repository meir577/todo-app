<?php

declare(strict_types=1);

namespace App\DTO;

class TagDto extends AbstractDto
{
    public function __construct(
        private readonly string $name,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
