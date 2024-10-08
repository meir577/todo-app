<?php

declare(strict_types=1);

namespace App\Usecases\Tag\Input;

use App\Domain\Task\Entity\Task;
use App\DTO\TagDto;
use MechtaMarket\PhpEnhance\Base\BaseInput;

class CreateTagToTaskUsecaseInput extends BaseInput
{
    public function __construct(
        private readonly Task  $task,
        private readonly TagDto $data,
    )
    {
    }

    public function getTaskId(): int
    {
        return $this->task->id;
    }

    public function getData(): array
    {
        return $this->data->toArray();
    }
}
