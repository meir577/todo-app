<?php

declare(strict_types=1);

namespace App\Usecases\Task\Input;

use App\Domain\Task\Entity\Task;
use MechtaMarket\PhpEnhance\Base\BaseInput;

class DeleteTaskUsecaseInput extends BaseInput
{
    public function __construct(
        private readonly Task $task,
    )
    {
    }

    public function getTask(): Task
    {
        return $this->task;
    }
}
