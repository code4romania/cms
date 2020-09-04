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

    //
    'inline_blocks_templates' => true,

    // Use builtin twill blocks
    'use_twill_blocks' => false,


    'directories' => [
        'source' => [
            'blocks' => [
                [
                    'path' => resource_path('views/admin/blocks'),
                    'source' => A17\Twill\Services\Blocks\Block::SOURCE_APP,
                ],
            ],

            'repeaters' => [
                [
                    'path' => resource_path('views/admin/repeaters'),
                    'source' => A17\Twill\Services\Blocks\Block::SOURCE_APP,
                ],
            ],

            'icons' => [
                base_path('vendor/area17/twill/frontend/icons'),
                resource_path('assets/svg/icons'),
            ],
        ],

        'destination' => [
            'make_dir' => true,

            'blocks' => resource_path('views/admin/blocks'),

            'repeaters' => resource_path('views/admin/repeaters'),
        ],
    ],
];
