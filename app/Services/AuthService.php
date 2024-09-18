<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\TokenDto;
use App\Exceptions\Auth\AuthException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    public function __construct(
        private readonly UserService $userService,
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

        $user = $this->userService->getUser();
        $expiresAt = now()->addDay();
        $token = $user->createToken(config('app.name'), expiresAt: $expiresAt)->plainTextToken;

        return new TokenDto(
            $token,
            $expiresAt->timezone('Asia/Almaty')->toDateTimeString(),
        );
    }

    public function getCurrentUser(): array
    {
        return $this->userService->getUser();
    }

    public function logout(): void
    {
        $this->userService->revokeToken();
    }
}
