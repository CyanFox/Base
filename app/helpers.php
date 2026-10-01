<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;

if (!function_exists('apiResponse')) {
    function apiResponse($message, $data = [], bool $success = true, int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}

if (!function_exists('carbon')) {
    function carbon($time = null, $tz = null): Carbon
    {
        return new Carbon($time, $tz);
    }
}

if (!function_exists('formatFileSize')) {
    function formatFileSize(int|float $bytes, int $precision = 0, ?int $maxPrecision = null): string
    {
        return Number::fileSize($bytes, $precision, $maxPrecision);
    }
}
