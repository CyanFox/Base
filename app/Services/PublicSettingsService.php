<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\SettingNotFoundException;
use App\Models\PublicSetting;
use App\Models\Setting;
use App\Traits\HandleSettingsValues;

class PublicSettingsService
{
    use HandleSettingsValues;

    public function getSetting(string $key, $default = null): mixed
    {
        return cache()->remember("public_setting_{$key}", 60 * 60, function () use ($key, $default) {
            $setting = PublicSetting::where('key', $key)->first();
            if ($setting === null) {
                return $default;
            }

            return $this->decryptIfNeeded($setting->value);
        });
    }

    public function setSetting(string $key, ?string $value = null, bool $auth = false, bool $updateIfExists = false): PublicSetting
    {
        cache()->forget("public_setting_{$key}");

        if (!$updateIfExists) {
            return PublicSetting::firstOrCreate([
                'key' => $key,
            ], [
                'value' => $value,
                'auth' => $auth,
            ]);
        }

        return PublicSetting::updateOrCreate([
            'key' => $key,
        ], [
            'value' => $value,
            'auth' => $auth,
        ]);
    }

    /**
     * @throws SettingNotFoundException
     */
    public function updateSetting(string $key, ?string $value = null, bool $auth = false): PublicSetting
    {
        $setting = PublicSetting::where('key', $key)->first();

        if ($setting === null) {
            throw new SettingNotFoundException($key);
        }
        cache()->forget("public_setting_{$key}");

        $setting->update([
            'value' => $value,
            'auth' => $auth,
        ]);

        return $setting;
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

    public function deleteSetting(string $key): bool
    {
        $setting = PublicSetting::where('key', $key)->first();

        if ($setting !== null) {
            cache()->forget("public_setting_{$key}");

            return $setting->delete();
        }

        return false;
    }
}
