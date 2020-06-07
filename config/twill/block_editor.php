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
            'group'      => 'content',
        ],
        'callToAction' => [
            'title'      => 'Call to action',
            'icon'       => 'colors',
            'component'  => 'a17-block-callToAction',
            'group'      => 'content',
        ],
        'cityLabs' => [
            'title'      => 'City labs list',
            'icon'       => 'fix-grid',
            'component'  => 'a17-block-cityLabs',
            'group'      => 'content',
        ],
        'counter' => [
            'title'      => 'Counter',
            'icon'       => 'star-feature',
            'component'  => 'a17-block-counter',
            'group'      => 'content',
        ],
        'embed' => [
            'title'      => 'Embed',
            'icon'       => 'revision-single',
            'component'  => 'a17-block-embed',
            'group'      => 'content',
        ],
        'hero' => [
            'title'      => 'Hero section',
            'icon'       => 'website',
            'component'  => 'a17-block-hero',
            'group'      => 'content',
        ],
        'imageGrid' => [
            'title'      => 'Image grid',
            'icon'       => 'fix-grid',
            'component'  => 'a17-block-imageGrid',
            'group'      => 'content',
        ],
        'imageText' => [
            'title'      => 'Image with text',
            'icon'       => 'image-text',
            'component'  => 'a17-block-imageText',
            'group'      => 'content',
        ],
        'newsletter' => [
            'title'      => 'Subscribe to newsletter',
            'icon'       => 'info',
            'component'  => 'a17-block-newsletter',
            'group'      => 'content',
        ],
        'notice' => [
            'title'      => 'Notice',
            'icon'       => 'info',
            'component'  => 'a17-block-notice',
            'group'      => 'content',
        ],
        'people' => [
            'title'      => 'People list',
            'icon'       => 'fix-grid',
            'component'  => 'a17-block-people',
            'group'      => 'content',
        ],
        'partners' => [
            'title'      => 'Partners list',
            'icon'       => 'fix-grid',
            'component'  => 'a17-block-partners',
            'group'      => 'content',
        ],
        'quote' => [
            'title'      => 'Quote',
            'icon'       => 'quote',
            'component'  => 'a17-block-quote',
            'group'      => 'content',
        ],
        'text' => [
            'title'      => 'Text',
            'icon'       => 'text',
            'component'  => 'a17-block-text',
            'group'      => 'content',
        ],

        'menuItem' => [
            'title'      => 'Menu Item',
            'icon'       => 'info',
            'component'  => 'a17-block-menuItem',
            'group'      => 'menu',
        ],
        'formSection' => [
            'title'      => 'Form Section',
            'icon'       => 'editor',
            'component'  => 'a17-block-formSection',
            'group'      => 'form',
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
        'subMenuItem' => [
            'title'      => 'Submenu Item',
            'trigger'    => 'Add submenu item',
            'component'  => 'a17-block-subMenuItem',
            'max'        => 20,
        ],
        'formField' => [
            'title'      => 'Form Field',
            'trigger'    => 'Add field',
            'component'  => 'a17-block-formField',
        ],
    ],

];
