<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class InternalSetting extends Model
{
    protected $fillable = [
        'language_key',
        'key',
        'value',
        'encrypted',
    ];

    public function access(): MorphMany
    {
        return $this->morphMany(SettingAccess::class, 'setting');
    }

    public function casts()
    {
        return [
            'encrypted' => 'boolean',
        ];
    }
}
