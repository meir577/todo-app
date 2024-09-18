<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class IsTaskOwnerRule implements InvokableRule
{
    public function __invoke($attribute, $value, $fail)
    {
        if (auth()->user()->load('projects.tasks')->where('id', $value)->count() === 0) {
            return $fail('You don\'t have permission to this task.');
        }
    }
}
