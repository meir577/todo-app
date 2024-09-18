<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthRequest;
use App\Usecases\Auth\CurrentUserUserCase;
use App\Usecases\Auth\Input\LoginUsecaseInput;
use App\Usecases\Auth\LoginUsecase;
use App\Usecases\Auth\LogoutUsecase;
use Illuminate\Http\JsonResponse;

class AuthController extends AbstractController
{
    public function login(AuthRequest $credentials, LoginUsecase $loginUsecase): JsonResponse
    {
        $loginUsecaseInput = new LoginUsecaseInput($credentials->getData());

        $loginUsecase->setInput($loginUsecaseInput);

        $loginUsecase->execute();

        $response = $loginUsecase->getOutput();

        return $this->json($response);
    }

    public function user(CurrentUserUserCase $currentUserUserCase): JsonResponse
    {
        $currentUserUserCase->execute();

        $response = $currentUserUserCase->getOutput();

        return $this->json($response);
    }

    public function logout(LogoutUsecase $logoutUsecase): JsonResponse
    {
        $logoutUsecase->execute();

        $response = $logoutUsecase->getOutput();

        return $this->json($response);
    }
}
