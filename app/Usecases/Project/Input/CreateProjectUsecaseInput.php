<?php

declare(strict_types=1);

namespace App\Usecases\Project\Input;

use App\DTO\ProjectDto;
use MechtaMarket\PhpEnhance\Base\BaseInput;

class CreateProjectUsecaseInput extends BaseInput
{
    public function __construct(
        private readonly ProjectDto $data
    )
    {
    }

    public function getData(): array
    {
        return array_filter([
            'name' => $this->data->getName(),
            'project_id' => $this->data->getProjectId(),
            'user_id' => auth()->user()->getAuthIdentifier(),
        ], fn(mixed $value) => !is_null($value));
    }
}
