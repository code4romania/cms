<?php

declare(strict_types=1);

return [

    // this should control the allowed depth in UI
    // but doesn't seem to actually do anything
    'nestedDepth' => 2,

    // Used to generate the social settings admin page and frontend footer
    'socialNetworks' => [
        'facebook' => [
            'name' => 'Facebook',
            'baseUrl' => 'https://www.facebook.com/',
        ],
        'twitter' => [
            'name' => 'Twitter',
            'baseUrl' => 'https://twitter.com/',
        ],
        'github' => [
            'name' => 'GitHub',
            'baseUrl' => 'https://github.com/',
        ],
        'linkedin' => [
            'name' => 'LinkedIn',
            'baseUrl' => 'https://www.linkedin.com/',
        ],
    ]

];
