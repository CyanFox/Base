<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'is_textarea',
        'is_locked',
        'is_public',
    ];

    protected static function boot()
    {
        parent::boot();

        self::retrieved(function ($setting): void {
            Cache::remember('setting_'.$setting->key, 60 * 60 * 24, fn () => $setting->value);
        });

        self::creating(function ($setting): true {
            Cache::remember('setting_'.$setting->key, 60 * 60 * 24, fn () => $setting->value);

            return true;
        });

        self::updating(function ($setting): bool {
            if ($setting->isDirty('is_locked')) {
                return true;
            }
            if ($setting->isDirty('value') && $setting->is_locked) {
                Log::debug('Attempted to update locked setting: '.$setting->key);

                return false;
            }

            Cache::forget('setting_'.$setting->key);

            return true;
        });

        self::deleting(function ($setting): true {
            Cache::forget('setting_'.$setting->key);

            return true;
        });
    }

    protected function casts(): array
    {
        return [
            'is_locked' => 'boolean',
        ];
    }
}
