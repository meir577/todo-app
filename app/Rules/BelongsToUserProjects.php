<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Symfony\Component\HttpFoundation\Response;

class BelongsToUserProjects implements InvokableRule
{
    public function __invoke($attribute, $value, $fail)
    {
        if (! auth()->user()->projects->find($value)) {
            abort(Response::HTTP_NOT_FOUND, 'Project not found');
        }
    }
}
