<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\Auth\AuthException;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\NotFoundResponse;
use App\Http\Responses\UnauthorizedResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(): void
    {
        $this->renderable(function (\Exception $e, $request) {
            if ($request->is('api/*')) {
                if ($e instanceof NotFoundHttpException) {
                    return new NotFoundResponse();
                }

                if ($e instanceof AuthException) {
                    return new ErrorResponse([], $e->getMessage(), $e->getCode());
                }
            }
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception): UnauthorizedResponse
    {
        return new UnauthorizedResponse();
    }
}
