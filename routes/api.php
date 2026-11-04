<?php

use App\Http\Controllers\API\CSRFTokenRefreshController;
use App\Http\Controllers\API\HealthCheckController;
use App\Http\Controllers\API\LanguageController;

Route::group(['prefix' => 'v1'], function () {
    Route::get('health', [HealthCheckController::class, 'checkHealth']);
    Route::get('refresh-csrf', [CSRFTokenRefreshController::class, 'refreshToken'])->middleware(['throttle:60,1', 'web']);
    Route::get('lang', [LanguageController::class, 'getKey'])->middleware(['web'])->where('key', '.*');
});
