<?php

declare(strict_types=1);

namespace App\Usecases\Project\Input;

use App\Models\Project;
use MechtaMarket\PhpEnhance\Base\BaseInput;

class DeleteProjectUsecaseInput extends BaseInput
{
    public function __construct(
        private readonly Project $project,
    )
    {
    }

    public function getProject(): Project
    {
        return $this->project;
    }
}
