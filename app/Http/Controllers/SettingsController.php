<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;

class SettingsController
{
    public function getSetting(Request $request, $key): \Illuminate\Http\JsonResponse
    {
        $setting = Setting::where(['key' => $key, 'is_public' => true])->first();

        if (!$setting) {
            return apiResponse('Setting not found', null, false, 404);
        }

        try {
            $setting->value = decrypt($setting->value);
        } catch (Exception) {
        }

        return apiResponse('Setting retrieved successfully', $setting);
    }

    public function getSettings(): \Illuminate\Http\JsonResponse
    {
        $settings = Setting::where('is_public', true)->get();

        foreach ($settings as $setting) {
            try {
                $setting->value = decrypt($setting->value);
            } catch (Exception) {
            }
        }

        return apiResponse('Settings retrieved successfully', $settings);
    }
}
