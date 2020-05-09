<?php

declare(strict_types=1);

$navigation = [
    'pages' => [
        'title' => 'Pages',
        'module' => true,
    ],
];

if (config('cms.enabled.people')) {
    $navigation['people'] = [
        'title' => 'People',
        'route' => 'admin.people.people.index',
        'primary_navigation' => [
            'people' => [
                'title' => 'People',
                'route' => 'admin.people.people.index',
            ],
            'cityLabs' => [
                'title' => 'City Labs',
                'route' => 'admin.people.cityLabs.index',
            ],
        ],
    ];
}

$navigation['partners'] = [
    'title' => 'Partners',
    'module' => true,
];

$navigation['settings'] = [
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
];

$navigation['menus'] = [
    'title' => 'Menus',
    'module' => true,
];

return $navigation;
