<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PublicSetting extends Model
{
    protected $fillable = [
        'language_key',
        'key',
        'value',
    ];

    public function access(): MorphMany
    {
        return $this->morphMany(SettingAccess::class, 'setting');
    }
}
