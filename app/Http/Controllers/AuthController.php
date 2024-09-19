<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthRequest;
use App\Usecases\Auth\CurrentUserUsecase;
use App\Usecases\Auth\Input\LoginUsecaseInput;
use App\Usecases\Auth\LoginUsecase;
use App\Usecases\Auth\LogoutUsecase;
use Illuminate\Http\JsonResponse;

class AuthController extends AbstractController
{
    public function login(AuthRequest $credentials, LoginUsecase $login_usecase): JsonResponse
    {
        $login_usecase_input = new LoginUsecaseInput($credentials->getData());

        $login_usecase->setInput($login_usecase_input);

        $login_usecase->execute();

        $response = $login_usecase->getOutput();

        return $this->json($response);
    }

    public function user(CurrentUserUsecase $current_user_usecase): JsonResponse
    {
        $current_user_usecase->execute();

        $response = $current_user_usecase->getOutput();

        return $this->json($response);
    }

    public function logout(LogoutUsecase $logout_usecase): JsonResponse
    {
        $logout_usecase->execute();

        $response = $logout_usecase->getOutput();

        return $this->json($response);
    }
}
