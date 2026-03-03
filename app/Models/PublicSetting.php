<?php

declare(strict_types=1);

namespace App\Models;

use BehindSolution\LaravelQueryGate\Support\QueryGate;
use BehindSolution\LaravelQueryGate\Traits\HasQueryGate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PublicSetting extends Model
{
    use HasQueryGate;

    protected $fillable = [
        'key',
        'value',
        'auth',
    ];

    protected $casts = [
        'auth' => 'boolean',
    ];

    public static function queryGate(): QueryGate
    {
        return QueryGate::make()
            ->alias('public_settings')
            ->filters([
                'auth' => 'integer', // boolean => integer (0 or 1)
                'created_at' => 'date',
                'updated_at' => 'date',
                'key' => 'string',
            ])
            ->allowedFilters([
                'auth' => 'eq',
                'created_at' => ['eq', 'between'],
                'updated_at' => ['eq', 'between'],
                'key' => 'like',
            ])
            ->sorts(['key', 'created_at', 'updated_at'])
            ->query(fn ($query) => $query->where('auth', Auth::check()))
            ->rateLimit(300)
            ->actions(fn ($actions) => $actions->detail());
    }
}
