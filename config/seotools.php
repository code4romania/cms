<?php

/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        'defaults' => [
            // Set false to completely remove
            'title'       => env('APP_NAME'),

            // Put defaults.title before page title
            'titleBefore' => false,

            // Set false to completely remove
            'description' => false,

            'separator'   => ' | ',

            'keywords'    => [],

            // Set null for using Url::current(), set false to completely remove
            'canonical'   => null,

            // Set to 'all', 'none' or any combination of index/noindex & follow/nofollow
            'robots'      => false,
        ],

        // Webmaster tags are always added.
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
        ],

        'add_notranslate_class' => false,
    ],

    'opengraph' => [
        'defaults' => [
            // Set false to completely remove
            'title'       => env('APP_NAME'),

            // Set false to completely remove
            'description' => false,

            // Set null for using Url::current(), set false to completely remove
            'url'         => true,

            'type'        => false,

            'site_name'   => false,

            'images'      => [],
        ],
    ],

    'twitter' => [
        'defaults' => [
            'card' => 'summary',
            'site' => '@Code4Romania',
        ],
    ],

    'json-ld' => [
        'defaults' => [
            // Set false to completely remove
            'title'       => env('APP_NAME'),

            // Set false to completely remove
            'description' => false,

            // Set null for using Url::current(), set false to completely remove
            'url'         => null,

            'type'        => 'WebPage',

            'images'      => [],
        ],
    ],
];
