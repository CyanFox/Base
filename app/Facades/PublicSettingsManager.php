<?php

declare(strict_types=1);

namespace App\Facades;

use App\Services\PublicSettingsService;
use Illuminate\Support\Facades\Facade;

/**
 * @see PublicSettingsService
 */
class PublicSettingsManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PublicSettingsService::class;
    }
}
