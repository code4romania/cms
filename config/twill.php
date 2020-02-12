<?php

declare(strict_types=1);

return [

    'namespace' => '\\Code4Romania\\Cms',

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

    'migrations_use_big_integers' => true,

    'block_editor' => [
        'block_single_layout' => 'layouts.blocks', // layout to use when rendering a single block in the editor
        'block_views_path' => 'site.blocks', // path where a view file per block type is stored
        'block_views_mappings' => [], // custom mapping of block types and views
        'block_preview_render_childs' => true, // indicates if childs should be rendered when using repeater in blocks
        'block_presenter_path' => null, //Allow to set a custom presenter to a block model

        'blocks' => [
            'accordion' => [
                'title'      => 'Accordion',
                'icon'       => 'media-list',
                'component'  => 'a17-block-accordion',
            ],
            'embed' => [
                'title'      => 'Embed',
                'icon'       => 'revision-single',
                'component'  => 'a17-block-embed',
            ],
            'quote' => [
                'title'      => 'Quote',
                'icon'       => 'quote',
                'component'  => 'a17-block-quote',
            ],
            'imageFullWidth' => [
                'title'      => 'Full width image',
                'icon'       => 'image',
                'component'  => 'a17-block-imagefullwidth',
            ],
            'imageGrid' => [
                'title'      => 'Image grid',
                'icon'       => 'fix-grid',
                'component'  => 'a17-block-imagegrid',
            ],
            'imageText' => [
                'title'      => 'Image with text',
                'icon'       => 'image-text',
                'component'  => 'a17-block-imagetext',
            ],
            'cta' => [
                'title'      => 'Call to action',
                'icon'       => 'colors',
                'component'  => 'a17-block-cta',
            ],
            'newsletter' => [
                'title'      => 'Subscribe to newsletter',
                'icon'       => 'info',
                'component'  => 'a17-block-newsletter',
            ],
            'text' => [
                'title'      => 'Text',
                'icon'       => 'text',
                'component'  => 'a17-block-text',
            ],
        ],
    ],

    'toolbar_options' => [
        ['header' => [2, 3, false]],
        'bold', 'italic', 'underline', 'strike', 'link', 'blockquote',
        ['color' => []],
        ['background' => []],
        ['list' => 'ordered'],
        ['list' => 'bullet'],
        ['script' => 'sub'],
        ['script' => 'super'],
        ['align' => []],
        ['clean' => ''],
    ],
];
