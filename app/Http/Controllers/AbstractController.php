<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use MechtaMarket\PhpEnhance\Base\BaseOutput;

abstract class AbstractController extends Controller
{
    protected function json(BaseOutput $response): JsonResponse
    {
        if ($response->isFailed()) {
            return response()->json($response->getArrayResponse(), $response->getStatusCode());
        }

        return response()->json($response->getArrayResponse());
    }
}
