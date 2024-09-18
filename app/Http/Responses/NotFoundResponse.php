<?php

namespace App\Http\Responses;

class NotFoundResponse extends ErrorResponse
{
    public function __construct(mixed $data = [], int $status = 404, array $headers = [])
    {
        parent::__construct($data, 'Not found', $status, $headers);
    }
}
