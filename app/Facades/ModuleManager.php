<?php

declare(strict_types=1);

namespace App\Facades;

use App\Services\ModuleService;
use Illuminate\Support\Facades\Facade;

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
