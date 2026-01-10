<?php

namespace App\Console\Commands;

use App\Models\Setting;
use Illuminate\Console\Command;
use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\confirm;

class MigrateSettingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate settings from v2025.x.x to v2026.x.x';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // TODO: Implement
    }
}
