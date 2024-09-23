<?php

declare(strict_types=1);

namespace App\Domain\User\Services;

use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function __construct(
        private readonly UserRepository $user_repository
    )
    {
    }

    public function getUser(): User
    {
        return $this->user_repository->find(Auth::id());
    }

    public function revokeToken(): void
    {
        auth()->user()->currentAccessToken()->delete();
    }
}
