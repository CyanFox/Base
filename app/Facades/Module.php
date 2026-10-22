<?php

declare(strict_types=1);

namespace App\Facades;

use App\Services\ModuleService;
use Illuminate\Support\Facades\Facade;

class Module extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ModuleService::class;
    }
}
