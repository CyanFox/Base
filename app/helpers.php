<?php

use Illuminate\Http\JsonResponse;

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
