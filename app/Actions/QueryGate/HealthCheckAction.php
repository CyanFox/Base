<?php

namespace App\Actions\QueryGate;

use BehindSolution\LaravelQueryGate\Actions\AbstractQueryGateAction;
use BehindSolution\LaravelQueryGate\Actions\AbstractStandaloneAction;
use Illuminate\Foundation\Events\DiagnosingHealth;
use Illuminate\Support\Facades\Event;
use Throwable;

class HealthCheckAction extends AbstractStandaloneAction
{
    public function action(): string
    {
        return 'health';
    }

    public function method(): string
    {
        return 'GET';
    }

    /**
     * @throws Throwable
     */
    public function handle($request, array $payload)
    {
        $exception = null;
        try {
            Event::dispatch(new DiagnosingHealth());
        } catch (Throwable $e) {
            if (app()->hasDebugModeEnabled()) {
                throw $e;
            }

            report($e);

            $exception = $e->getMessage();
        }

        return apiResponse($exception ? 'unhealthy' : 'healthy', $exception, !$exception, $exception ? 500 : 200);
    }

    public function rateLimit(): ?array
    {
        return ['max_attempts' => 60, 'decay_minutes' => 1];
    }

    public function name(): ?string
    {
        return 'Health Check';
    }

    public function description(): ?string
    {
        return 'Returns the health status of the application.';
    }

    public function openapiResponse(): array
    {
        return [
            'success' => true,
            'message' => 'healthy',
            'data' => null,
        ];
    }
}
