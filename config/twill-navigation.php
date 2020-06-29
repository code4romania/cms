<?php

declare(strict_types=1);

$navigation = [
    'pages' => [
        'title' => 'Pages',
        'module' => true,
    ],
];

$navigation['blog'] = [
    'title' => 'Blog',
    'route' => 'admin.blog.posts.index',
    'primary_navigation' => [
        'posts' => [
            'title' => 'Posts',
            'route' => 'admin.blog.posts.index',
        ],
        'categories' => [
            'title' => 'Categories',
            'route' => 'admin.blog.categories.index',
        ],
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
        'social' => [
            'title' => 'Social',
            'route' => 'admin.settings',
            'params' => [
                'section' => 'social'
            ],
        ],
        'mailchimp' => [
            'title' => 'Mailchimp',
            'route' => 'admin.settings',
            'params' => [
                'section' => 'mailchimp'
            ],
        ],
    ],
];

$navigation['forms'] = [
    'title' => 'Forms',
    'route' => 'admin.forms.forms.index',
    'primary_navigation' => [
        'forms' => [
            'title' => 'Forms',
            'route' => 'admin.forms.forms.index',
        ],
        'responses' => [
            'title' => 'Responses',
            'route' => 'admin.forms.responses.index',
        ],
    ],
];

$navigation['menus'] = [
    'title' => 'Menus',
    'module' => true,
];

return $navigation;
