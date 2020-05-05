<?php

declare(strict_types=1);

return [

    'namespace' => 'Code4Romania\Cms',

    'admin_app_url' => env('ADMIN_APP_URL', env('APP_URL')),
    'admin_app_path' => env('ADMIN_APP_PATH', 'admin'),

    'migrations_use_big_integers' => true,
    'load_default_migrations_from_twill' => true,

    'enabled' => [

        'users-management' => true,
        'media-library' => true,
        'file-library' => true,
        'dashboard' => true,
        'search' => true,
        'block-editor' => true,
        'buckets' => false,
        'users-image' => false,
        'users-description' => false,
        'site-link' => false,
        'settings' => true,
        'activitylog' => true,

    ],

];
