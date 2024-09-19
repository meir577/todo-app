<?php

declare(strict_types=1);

namespace App\Usecases\Project\Input;

use App\Models\Project;
use MechtaMarket\PhpEnhance\Base\BaseInput;

class GetProjectUsecaseInput extends BaseInput
{
    public function __construct(
        private readonly int      $user_id,
        private readonly ?Project $project = null
    )
    {
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getProjectId(): ?int
    {
        return $this->project?->id;
    }
}
