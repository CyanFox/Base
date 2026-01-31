<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\SettingNotFoundException;
use App\Models\Setting;
use App\Traits\HandleSettingsValues;

class SettingsService
{
    use HandleSettingsValues;

    public function getSetting(string $key, $default = null): mixed
    {
        return cache()->remember("setting_{$key}", 60 * 60, function () use ($key, $default) {
            $setting = Setting::where('key', $key)->first();
            if ($setting === null) {
                return $default;
            }

            return $this->decryptIfNeeded($setting->value);
        });
    }

    public function setSetting(string $key, ?string $value = null, bool $updateIfExists = false): Setting
    {
        cache()->forget("setting_{$key}");

        if (!$updateIfExists) {
            return Setting::firstOrCreate([
                'key' => $key,
            ], [
                'value' => $value,
            ]);
        }

        return Setting::updateOrCreate([
            'key' => $key,
        ], [
            'value' => $value,
        ]);
    }

    /**
     * @throws SettingNotFoundException
     */
    public function updateSettings(array $settings): void
    {
        foreach ($settings as $key => $value) {
            $this->updateSetting($key, $value);
        }
    }

    /**
     * @throws SettingNotFoundException
     */
    public function updateSetting(string $key, ?string $value): Setting
    {
        $setting = Setting::where('key', $key)->first();

        if ($setting === null) {
            throw new SettingNotFoundException($key);
        }
        cache()->forget("setting_{$key}");

        $setting->update([
            'value' => $value,
        ]);

        return $setting;
    }

    public function deleteSetting(string $key): bool
    {
        $setting = Setting::where('key', $key)->first();

        if ($setting !== null) {
            cache()->forget("setting_{$key}");

            return $setting->delete();
        }

        return false;
    }
}
