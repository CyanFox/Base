<?php

declare(strict_types=1);

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: base_path('routes/api.php'),
        channels: base_path('routes/channels.php'),
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, Request $request): ?JsonResponse {
            if ($request->expectsJson() || $request->is('api/*')) {
                if ($e instanceof ValidationException) {
                    $details = [];
                    $errorMessages = $e->errors();
                    $failedRules = $e->validator->failed();

                    foreach ($errorMessages as $field => $messages) {
                        if (empty($messages)) {
                            continue;
                        }

                        $firstRule = array_key_first($failedRules[$field] ?? []);
                        $translationKey = $firstRule
                            ? 'validation.' . strtolower($firstRule)
                            : (is_string($messages[0]) && Lang::has($messages[0]) ? $messages[0] : null);

                        $details[$field] = [
                            'translation_key' => $translationKey,
                            'translated' => $translationKey ? __($translationKey) : $messages[0],
                        ];
                    }

                    return apiResponse($e->getMessage(), apiError('app.validation', details: $details), false, $e->status);
                }

                if ($e instanceof AuthenticationException) {
                    return apiResponse($e->getMessage(), apiError('app.unauthorized'), false, 401);
                }

                $statusCode = match (true) {
                    $e instanceof HttpExceptionInterface => $e->getStatusCode(),
                    default => 500,
                };

                return apiResponse($e->getMessage(), apiError('app.unknown', details: ['message' => $e->getMessage()]), false, $statusCode);
            }
            return null;
        });
    })->create();
