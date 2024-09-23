<?php

declare(strict_types=1);

namespace App\Usecases\Project\Output;

use App\Domain\Project\Entity\Project;
use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;

class DeleteProjectUsecaseData implements UsecaseDataInterface
{
    private readonly Project $data;

    public function setData(Project $data): void
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return [
            'id' => $this->data->id,
            'name' => $this->data->name,
            'user_id' => $this->data->user_id,
        ];
    }
}
