<?php

declare(strict_types=1);

namespace App\Usecases\Tag\Output;

use App\Domain\Tag\Entity\Tag;
use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;

class CreateTagToTaskUsecaseData implements UsecaseDataInterface
{
    private readonly Tag $data;

    public function setData(Tag $data): void
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return [
            'id' => $this->data->id,
            'name' => $this->data->name,
            'task_id' => $this->data->task_id,
        ];
    }
}
