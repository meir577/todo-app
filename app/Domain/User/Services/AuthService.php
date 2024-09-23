<?php

declare(strict_types=1);

namespace App\Domain\User\Services;

use App\Domain\User\Entity\User;
use App\DTO\TokenDto;
use App\Exceptions\Auth\AuthException;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct(
        private readonly UserService $user_service,
    )
    {
    }

    public function attempt(array $credentials): TokenDto
    {
        assert(Auth::attempt($credentials), new AuthException);

        $user = $this->user_service->getUser();
        $expires_at = now()->addDay()->timezone('Asia/Almaty');
        $token = $user->createToken(config('app.name'), expiresAt: $expires_at);

        return new TokenDto(
            $token->plainTextToken,
            $expires_at->toDateTimeString()
        );
    }

    public function getCurrentUser(): User
    {
        return $this->user_service->getUser();
    }

    public function logout(): void
    {
        $this->user_service->revokeToken();
    }
}
