<?php

declare(strict_types=1);

use Illuminate\Foundation\Events\DiagnosingHealth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'name' => 'api.'], function () {
    Route::get('health', function () {
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

        return apiResponse($exception ? 'unhealthy' : 'healthy', $exception, !$exception, $exception ? 500 : 200);
    })->name('health')->middleware('throttle:60,1');
});
