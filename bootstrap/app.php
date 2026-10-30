<?php

declare(strict_types=1);

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: base_path('routes/api.php'),
        channels: base_path('/../routes/channels.php'),
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, Request $request): ?JsonResponse {
            if ($request->expectsJson() || $request->is('api/*')) {
                if ($e instanceof ValidationException) {
                    return apiResponse($e->getMessage(), $e->errors(), false, $e->status);
                }

                $statusCode = match (true) {
                    $e instanceof AuthenticationException => 401,
                    $e instanceof HttpExceptionInterface => $e->getStatusCode(),
                    default => 500,
                };

                return apiResponse($e->getMessage(), [], false, $statusCode);
            }
            return null;
        });
    })->create();
