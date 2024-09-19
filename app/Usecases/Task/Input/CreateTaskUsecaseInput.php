<?php

declare(strict_types=1);

namespace App\Usecases\Task\Input;

use App\DTO\TaskDto;
use MechtaMarket\PhpEnhance\Base\BaseInput;

class CreateTaskUsecaseInput extends BaseInput
{
    public function __construct(
        private readonly TaskDto $data
    )
    {
    }

    public function getData(): array
    {
        return $this->data->toArray();
    }
}
