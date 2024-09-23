<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ErrorResponse extends JsonResponse
{
    public function __construct(mixed $data = [], array|string $messages = [], int $status = 400, array $headers = [])
    {
        parent::__construct([
            'result' => false,
            'errors' => $messages,
            'code' => $status,
            'data' => $data,
        ], $status, $headers);
    }
}
