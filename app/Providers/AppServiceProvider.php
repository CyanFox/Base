<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\QueryGate\HealthCheckAction;
use App\Facades\PublicSettingsManager;
use App\Facades\SettingsManager;
use App\Models\PublicSetting;
use App\Services\SpotlightService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('spotlight', fn($app): SpotlightService => new SpotlightService());
    }

    public function boot(): void
    {
        if (!config('settings.disable_db_settings') && !app()->runningInConsole()) {
            $publicConfigValues = [
                'app.name' => settings('internal.app.name', config('app.name')),
                'app.url' => settings('internal.app.url', config('app.url')),
                'app.timezone' => settings('internal.app.timezone', config('app.timezone')),
                'app.locale' => settings('internal.app.lang', config('app.locale')),
                'settings.force_https' => settings('internal.app.force_https', config('settings.force_https')),
                'settings.notifications.alignment' => settings('internal.app.notifications.alignment', config('settings.notifications.alignment')),
                'settings.notifications.vertical_alignment' => settings('internal.app.notifications.vertical_alignment', config('settings.notifications.vertical_alignment')),
            ];
            $configValues = [
                'sentry.dsn' => settings('internal.app.sentry_dsn', config('sentry.dsn')),
                'sentry.send_default_pii' => settings('internal.app.send_default_pii', config('sentry.send_default_pii')),
                'sentry.traces_sample_rate' => settings('internal.app.traces_sample_rate', config('sentry.traces_sample_rate')),
            ];

            foreach ($publicConfigValues as $key => $value) {
                Config::set($key, $value);
            }
            foreach ($configValues as $key => $value) {
                Config::set($key, $value);
            }
        }

        if (!app()->runningInConsole()) {
            addQueryGateStandaloneAction('health', HealthCheckAction::class);
            addQueryGateModel(PublicSetting::class);
        }

        if (Str::startsWith(config('app.url') ?? '', 'https://')) {
            URL::forceScheme('https');
        }
    }
}
