<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Nwidart\Modules\Facades\Module;

abstract class TestCase extends BaseTestCase
{
    /**
     * Register the migration paths of all modules on the migrator, so
     * RefreshDatabase (migrate:fresh) also runs the module migrations.
     */
    public function createApplication()
    {
        $app = parent::createApplication();

        foreach (Module::all() as $module) {
            $path = $module->getPath() . 'database' . DIRECTORY_SEPARATOR . 'migrations';

            if (is_dir($path)) {
                $app->make('migrator')->path($path);
            }
        }

        return $app;
    }
}
