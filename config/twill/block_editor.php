<?php

declare(strict_types=1);

return [

    // Layout to use when rendering a single block in the editor
    'block_single_layout' => 'front.layouts.blocks',

    // Path where a view file per block type is stored
    'block_views_path' => 'front.blocks',

    // Custom mapping of block types and views
    'block_views_mappings' => [],

    // Indicates if childs should be rendered when using repeater in blocks
    'block_preview_render_childs' => false,

    // Allows setting a custom presenter to a block model
    'block_presenter_path' => Code4Romania\Cms\Presenters\BlockPresenter::class,

    'blocks' => [
        'accordion' => [
            'title'      => 'Accordion',
            'icon'       => 'media-list',
            'component'  => 'a17-block-accordion',
        ],
        'counter' => [
            'title'      => 'Counter',
            'icon'       => 'star-feature',
            'component'  => 'a17-block-counter',
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
        'hero' => [
            'title'      => 'Hero section',
            'icon'       => 'website',
            'component'  => 'a17-block-hero',
        ],
        'imageGrid' => [
            'title'      => 'Image grid',
            'icon'       => 'fix-grid',
            'component'  => 'a17-block-imageGrid',
        ],
        'imageText' => [
            'title'      => 'Image with text',
            'icon'       => 'image-text',
            'component'  => 'a17-block-imageText',
        ],
        'callToAction' => [
            'title'      => 'Call to action',
            'icon'       => 'colors',
            'component'  => 'a17-block-callToAction',
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
        'menuItem' => [
            'title'      => 'Menu Item',
            'icon'       => 'info',
            'component'  => 'a17-block-menuItem',
        ],
    ],
    'repeaters' => [
        'accordionItem' => [
            'title'      => 'Item',
            'trigger'    => 'Add accordion item',
            'component'  => 'a17-block-accordionItem',
            'max'        => 20,
        ],
        'counterItem' => [
            'title'      => 'Item',
            'trigger'    => 'Add counter item',
            'component'  => 'a17-block-counterItem',
            'max'        => 20,
        ],
        'menuItem' => [
            'title'      => 'Menu Item',
            'trigger'    => 'Add menu item',
            'component'  => 'a17-block-menuItem',
            'max'        => 20,
        ],
    ],

];
