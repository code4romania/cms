<?php

declare(strict_types=1);

return [

    'pages' => [
        'title' => 'Pages',
        'module' => true,
    ],
    'settings' => [
        'title' => 'Settings',
        'route' => 'admin.settings',
        'params' => [
            'section' => 'site'
        ],
        'primary_navigation' => [
            'site' => [
                'title' => 'Site',
                'route' => 'admin.settings',
                'params' => [
                    'section' => 'site'
                ],
            ],
            'seo' => [
                'title' => 'SEO',
                'route' => 'admin.settings',
                'params' => [
                    'section' => 'seo'
                ],
            ],
            'social' => [
                'title' => 'Social',
                'route' => 'admin.settings',
                'params' => [
                    'section' => 'social'
                ],
            ],
        ],
    ],
    'menuItems' => [
        'title' => 'Menus',
        'module' => true,
    ],
];
