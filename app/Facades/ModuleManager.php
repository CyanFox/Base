<?php

namespace App\Facades;

use App\Services\ModuleService;
use Illuminate\Support\Facades\Facade;
use Nwidart\Modules\Module;

/**
 * @see ModuleService
 */
class ModuleManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ModuleService::class;
    }
}
