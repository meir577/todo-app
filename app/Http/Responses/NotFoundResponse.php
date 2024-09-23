<?php

namespace App\Http\Responses;

class NotFoundResponse extends ErrorResponse
{
    public function __construct(mixed $data = [], array $messages = ['Not found'], int $status = 404, array $headers = [])
    {
        parent::__construct($data, $messages, $status, $headers);
    }
}
