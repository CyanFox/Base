<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'auth',
        'permission',
        'group',
    ];

    protected $casts = [
        'auth' => 'boolean',
    ];
}
