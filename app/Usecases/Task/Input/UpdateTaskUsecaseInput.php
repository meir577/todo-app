<?php

declare(strict_types=1);

namespace App\Usecases\Task\Input;

use App\Models\Task;
use MechtaMarket\PhpEnhance\Base\BaseInput;

class UpdateTaskUsecaseInput extends BaseInput
{
    public function __construct(
        private readonly Task  $task,
        private readonly array $data
    )
    {
    }

    public function getTask(): Task
    {
        return $this->task;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
