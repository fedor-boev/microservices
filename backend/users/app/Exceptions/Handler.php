<?php

namespace App\Exceptions;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

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
     * @TODO current password ?
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
//        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * TODO register ?
     *
     * Register the exception handling callbacks for the application.
     */
//    public function register(): void
//    {
//        $this->reportable(function (Throwable $e) {
//            //
//        });
//    }

    /**
     * @TODO ?
     *
     * @param $request
     * @param Throwable $exception
     * @return Application|ResponseFactory|JsonResponse|Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
        return response([
            'error' => $exception->getMessage(),
        ], $exception->getCode() ? $exception->getCode() : 400);
    }

    /**
     * @TODO ?
     *
     * @param $request
     * @param $exception
     * @return Application|ResponseFactory|Response|\Symfony\Component\HttpFoundation\Response
     */
    public function unauthenticated($request, $exception)
    {
        return response(['error' => 'unauthenticated'], 401);
    }
}
