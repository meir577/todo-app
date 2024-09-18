<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    public function getUser(): array
    {
        return $this->userRepository->find(Auth::id())->toArray();
    }

    public function revokeToken(): void
    {
        auth()->user()->currentAccessToken()->delete();
    }
}
