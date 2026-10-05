<?php

use App\Http\Controllers\API\HealthCheckController;

Route::group(['prefix' => 'v1'], function () {
    Route::get('health', [HealthCheckController::class, 'checkHealth'])->middleware('throttle:10,1');
    Route::get('refresh-csrf', fn() => apiResponse('csrf token refreshed', ['token' => csrf_token()]))->middleware(['throttle:60,1', 'web']);
    Route::get('lang/{key}', fn($key) => apiResponse(__($key), ['key' => $key, 'value' => __($key), 'lang' => app()->getLocale()]))->middleware(['throttle:60,1', 'web'])->where('key', '.*');
});
