<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Twill Glide configuration
    |--------------------------------------------------------------------------
    |
    | This array allows you to provide the package with your configuration
    | for the Glide image service.
    |
    */

    'source'             => env('GLIDE_SOURCE', storage_path('app/public/' . env('MEDIA_LIBRARY_LOCAL_PATH', 'uploads'))),
    'cache'              => env('GLIDE_CACHE', storage_path('app')),
    'cache_path_prefix'  => env('GLIDE_CACHE_PATH_PREFIX', 'glide_cache'),
    'base_url'           => env('GLIDE_BASE_URL', env('APP_URL', 'http://localhost')),
    'base_path'          => env('GLIDE_BASE_PATH', 'img'),
    'use_signed_urls'    => env('GLIDE_USE_SIGNED_URLS', false),
    'sign_key'           => env('GLIDE_SIGN_KEY'),
    'driver'             => env('GLIDE_DRIVER', 'gd'),
    'add_params_to_svgs' => false,

    'default_params' => [
        // 'fm'  => 'jpg',
        'q'   => '80',
        'fit' => 'max',
    ],

    'lqip_default_params' => [
        'fm'   => 'png',
        'blur' => 10,
        'dpr'  => 1,
    ],

    'social_default_params' => [
        'fm'  => 'jpg',
        'w'   => 1200,
        'h'   => 630,
        'fit' => 'crop',
    ],

    'cms_default_params' => [
        'q'   => '60',
        'dpr' => '1',
    ],

    'presets' => [
        //
    ],
];
