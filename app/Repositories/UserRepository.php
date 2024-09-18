<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function find(int $id): User
    {
        return User::where('id', $id)->first();
    }
}
