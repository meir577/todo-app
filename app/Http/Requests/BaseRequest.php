<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DTO\AbstractDto;
use App\Http\Responses\ErrorResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            new ErrorResponse([], $validator->errors()->getMessages(), 422)
        );
    }

    abstract public function getData(): AbstractDto;
}
