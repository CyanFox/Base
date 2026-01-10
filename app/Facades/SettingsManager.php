<?php

namespace App\Facades;

use App\Services\SettingsService;
use Illuminate\Support\Facades\Facade;

/**
 * @see SettingsService
 */
class SettingsManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SettingsService::class;
    }
}
