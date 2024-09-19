<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\DTO\CredentialsDto;
use App\Http\Requests\BaseRequest;

class AuthRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.exists' => 'User not found',
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email address',
            'password.required' => 'Password is required',
        ];
    }

    public function getData(): CredentialsDto
    {
        return new CredentialsDto(
            $this->get('email'),
            $this->get('password')
        );
    }
}
