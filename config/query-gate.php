<?php

return [
    'route' => [
        'prefix' => 'api/v1',
        'middleware' => [],
    ],

    'pagination' => [
        'per_page' => 50,
        'max_per_page' => 500,
    ],

    'default_version' => null,

    'standalone_actions' => [

    ],

    'openAPI' => [
        'enabled' => true,
        'title' => 'CyanFox Base Public API',
        'description' => 'API documentation for CyanFox Base public endpoints.',
        'version' => 'v1',
        'route' => 'api/docs',
        'json_route' => null,
        'ui' => 'swagger-ui',
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

    ],

];

