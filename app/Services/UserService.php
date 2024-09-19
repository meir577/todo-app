<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
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
