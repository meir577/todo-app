<?php

declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\User\Entity\User;

class UserRepository
{
    public function find(int $id): User
    {
        return User::where('id', $id)->first();
    }
}
