<?php

declare(strict_types=1);

namespace App\DTO;

abstract class AbstractDto
{
    abstract public function toArray(): array;
}
