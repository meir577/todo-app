<?php

declare(strict_types=1);

namespace App\Domain\Project\Entity\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SelfProjectsOnly implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('user_id', auth()->user()->getAuthIdentifier());
    }
}
