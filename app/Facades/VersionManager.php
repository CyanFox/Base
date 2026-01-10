<?php

namespace App\Facades;

use App\Services\VersionService;
use Illuminate\Support\Facades\Facade;

/**
 * @see VersionService
 */
class VersionManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return VersionService::class;
    }
}
