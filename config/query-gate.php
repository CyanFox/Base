<?php

use BehindSolution\LaravelQueryGate\Support\QueryGate;

return [
    'route' => [
        'prefix' => 'api/v1',
        'middleware' => [],
    ],

    'pagination' => [
        'per_page' => 50,
        'max_per_page' => 500,
    ],

    'openAPI' => [
        'enabled' => true,
        'title' => 'CyanFox Base Public API',
        'description' => 'API documentation for CyanFox Base public endpoints.',
        'version' => 'v1',
        'route' => 'api/v1/docs',
        'json_route' => null,
        'ui' => 'redoc',
        'ui_options' => [],
        'servers' => [],
        'output' => [
            'format' => 'json',
            'path' => storage_path('app/query-gate-openapi.json'),
        ],
        'auth' => [
            'type' => null,
            'name' => null,
            'in' => 'header',
            'scheme' => null,
            'bearer_format' => null,
            'flows' => [],
        ],
        'tags' => [],
        'middleware' => [],
        'modifiers' => [],
    ],

    'models' => [
        // App\Models\User::class => QueryGate::make()
        //     ->alias('users')
        //     ->query(fn ($query) => $query->where('active', true))
        //     ->middleware(['auth:sanctum'])
        //     ->version('2024-01-01', function (QueryGate $gate) {
        //         $gate->filters([
        //             'name' => 'string',
        //             'email' => 'email',
        //         ])->allowedFilters([
        //             'name' => ['like'],
        //             'email' => ['eq'],
        //         ])->select(['id', 'name', 'email']);
        //     })
        //     ->version('2024-11-01', function (QueryGate $gate) {
        //         $gate->filters([
        //             'name' => 'string',
        //             'email' => 'email',
        //             'created_at' => 'date',
        //         ])->allowedFilters([
        //             'name' => ['like'],
        //             'email' => ['eq', 'like'],
        //             'created_at' => ['gte', 'lte', 'between'],
        //         ])->select(['id', 'name', 'email', 'created_at']);
        //     }),
        //
        // // Or simply list the model class when it implements HasQueryGate:
        // App\Models\User::class,
    ],

];

