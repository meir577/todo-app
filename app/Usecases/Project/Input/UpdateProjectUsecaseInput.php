<?php

declare(strict_types=1);

namespace App\Usecases\Project\Input;

use App\Models\Project;
use MechtaMarket\PhpEnhance\Base\BaseInput;

class UpdateProjectUsecaseInput extends BaseInput
{
    public function __construct(
        private readonly Project $project,
        private readonly array   $data
    )
    {
    }

    public function getProject(): Project
    {
        return $this->project;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
