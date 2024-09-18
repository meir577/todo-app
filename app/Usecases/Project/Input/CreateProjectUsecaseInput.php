<?php

declare(strict_types=1);

namespace App\Usecases\Project\Input;

use MechtaMarket\PhpEnhance\Base\BaseInput;

class CreateProjectUsecaseInput extends BaseInput
{
    public function __construct(
        private readonly array $data
    )
    {
    }

    public function getData(): array
    {
        return $this->data;
    }
}
