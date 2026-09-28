<?php

use App\Http\Controllers\API\HealthCheckController;

Route::group(['prefix' => 'v1'], function () {
    Route::get('health', [HealthCheckController::class, 'checkHealth'])->middleware('throttle:10,1');
});
