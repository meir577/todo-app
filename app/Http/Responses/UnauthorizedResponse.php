<?php

namespace App\Http\Responses;

class UnauthorizedResponse extends ErrorResponse
{
    public function __construct(mixed $data = [], int $status = 401, array $headers = [])
    {
        parent::__construct(['Not Authorized'], null, $status, $headers);
    }
}
