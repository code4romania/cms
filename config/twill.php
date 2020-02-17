<?php

declare(strict_types=1);

return [

    'namespace' => 'Code4Romania\Cms',

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

    'toolbar_options' => [

        ['header' => [2, 3, false]],
        'bold', 'italic', 'underline', 'strike', 'link', 'blockquote',
        // ['color' => []],
        // ['background' => []],
        ['list' => 'ordered'],
        ['list' => 'bullet'],
        ['script' => 'sub'],
        ['script' => 'super'],
        ['align' => []],
        ['clean' => ''],

    ],

];
