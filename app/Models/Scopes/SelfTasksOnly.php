<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SelfTasksOnly implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder->whereIn('project_id', auth()->user()->projects->pluck('id'));
    }
}
