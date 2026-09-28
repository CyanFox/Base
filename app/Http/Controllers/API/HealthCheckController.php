<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Dedoc\Scramble\Attributes\Endpoint;
use Dedoc\Scramble\Attributes\Response;
use Illuminate\Foundation\Events\DiagnosingHealth;
use Illuminate\Support\Facades\Event;
use Throwable;

class HealthCheckController extends Controller
{
    /**
     * @throws Throwable
     */
    #[Endpoint(
        title: 'Check application health',
    )]
    #[Response(200, 'Health check passed', examples: ['application/json' => ['success' => true, 'message' => 'Health check passed', 'date' => []]])]
    #[Response(500, 'Health check failed', examples: ['application/json' => ['success' => false, 'message' => 'Health check failed', 'date' => []]])]
    public function checkHealth()
    {
        $exception = null;

        try {
            Event::dispatch(new DiagnosingHealth);
        } catch (Throwable $e) {
            if (app()->hasDebugModeEnabled()) {
                throw $e;
            }

            report($e);

            $exception = $e->getMessage();
        }

        $status = $exception ? 500 : 200;

        return apiResponse($exception ? 'Health check failed' : 'Health check passed', success: !$exception, statusCode: $status);
    }
}
