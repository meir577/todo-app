<?php

declare(strict_types=1);

namespace App\Domain\User\Services;

use App\Domain\User\Entity\User;
use App\DTO\TokenDto;
use App\Exceptions\Auth\AuthException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    public function __construct(
        private readonly UserService $user_service,
    ) {
    }

    /**
     * @throws AuthException
     */
    public function attempt(array $credentials): TokenDto
    {
        if (! Auth::attempt($credentials)) {
            throw new AuthException('Invalid credentials', Response::HTTP_UNAUTHORIZED);
        }

        $user = $this->user_service->getUser();
        $expires_at = now()->addDay();
        $token = $user->createToken(config('app.name'), expiresAt: $expires_at)->plainTextToken;

        return new TokenDto(
            $token,
            $expires_at->timezone('Asia/Almaty')->toDateTimeString(),
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
