<?php

namespace Database\Seeders;

use App\Facades\PublicSettingsManager;
use App\Facades\SettingsManager;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publicSettings = [
            'internal.app.name' => config('app.name'),
            'internal.app.url' => config('app.url'),
            'internal.app.timezone' => config('app.timezone'),
            'internal.app.lang' => config('app.locale'),
            'internal.app.force_https' => config('settings.force_https'),
            'internal.app.notifications.alignment' => config('settings.notifications.alignment'),
            'internal.app.notifications.vertical_alignment' => config('settings.notifications.vertical_alignment'),
            'internal.app.logo_path' => config('settings.logo_path'),
        ];

        $settings = [
            'internal.app.sentry_dsn' => config('sentry.dsn'),
            'internal.app.send_default_pii' => config('sentry.send_default_pii'),
            'internal.app.traces_sample_rate' => config('sentry.traces_sample_rate'),
        ];

        foreach ($publicSettings as $name => $value) {
            PublicSettingsManager::setSetting($name, $value);
        }

        foreach ($settings as $name => $value) {
            SettingsManager::setSetting($name, $value);
        }
    }
}
