<?php

declare(strict_types=1);

namespace App\Usecases\Tag\Input;

use App\Models\Tag;
use MechtaMarket\PhpEnhance\Base\BaseInput;

class DeleteTagFromTaskUsecaseInput extends BaseInput
{
    public function __construct(
        private readonly Tag $tag,
    )
    {
    }

    public function getData(): array
    {
        return $this->tag->toArray();
    }
}
