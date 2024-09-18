<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ErrorResponse extends JsonResponse
{
    public function __construct(mixed $data = [], ?string $message = null, int $status = 400, array $headers = [])
    {
        parent::__construct([
            'result' => false,
            'errors' => $data,
            'code' => $status,
            'data' => $message,
        ], $status, $headers);
    }
}
