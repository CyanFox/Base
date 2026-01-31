<?php

declare(strict_types=1);

use App\Facades\SettingsManager;
use App\Services\ModuleService;
use App\Services\SettingsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;

if (!function_exists('settings')) {
    function settings($key = null, $default = null): mixed
    {
        if ($key === null) {
            return new SettingsService;
        }

        return SettingsManager::getSetting($key, $default);
    }
}

if (!function_exists('publicSettings')) {
    function publicSettings($key = null, $default = null): mixed
    {
        if ($key === null) {
            return new SettingsService;
        }

        return SettingsManager::getSetting($key, $default);
    }
}

if (!function_exists('modules')) {
    function modules(): ModuleService
    {
        return new ModuleService;
    }
}

if (!function_exists('formatFileSize')) {
    function formatFileSize(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $power = $bytes > 0 ? min(floor(log($bytes, 1024)), count($units) - 1) : 0;
        $size = round($bytes / 1024 ** $power, 2);

        return $size . ' ' . $units[$power];
    }
}

if (!function_exists('formatDateTime')) {
    function formatDateTime($date, $format = null): string
    {
        if (blank($date)) {
            return '';
        }

        if ($format) {
            return Carbon::parse($date)->format($format);
        }

        return Carbon::parse($date)->format(settings('internal.app.date_format', 'Y-m-d') . ' ' . settings('internal.app.time_format', 'H:i'));
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date, $format = null): string
    {
        if (blank($date)) {
            return '';
        }

        if ($format) {
            return Carbon::parse($date)->format($format);
        }

        return Carbon::parse($date)->format(settings('internal.app.date_format', 'Y-m-d'));
    }
}

if (!function_exists('formatTime')) {
    function formatTime(string $time, $format = null): string
    {
        if (blank($time)) {
            return '';
        }

        if ($format) {
            return Carbon::parse($time)->format($format);
        }

        return Carbon::parse($time)->format(settings('internal.app.time_format', 'H:i'));
    }
}

if (!function_exists('carbon')) {
    function carbon($time = null, $tz = null): Carbon
    {
        return new Carbon($time, $tz);
    }
}

if (!function_exists('apiResponse')) {
    function apiResponse($message, $data = null, bool $success = true, int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}

if (!function_exists('addQueryGateModel')) {
    function addQueryGateModel(string $modelClass, ?string $queryGateClass = null): void
    {
        if ($queryGateClass !== null) {
            Config::set('query-gate.models', array_merge(
                Config::get('query-gate.models', []),
                [$modelClass => $queryGateClass]
            ));
            return;
        }

        Config::set('query-gate.models', array_merge(
            Config::get('query-gate.models', []),
            [$modelClass]
        ));
    }
}

if (!function_exists('addQueryGateStandaloneAction')) {
    function addQueryGateStandaloneAction(string $actionName, string $actionClasses): void
    {
        Config::set('query-gate.standalone_actions', array_merge(
            Config::get('query-gate.standalone_actions', []),
            [$actionName => $actionClasses]
        ));
    }
}
