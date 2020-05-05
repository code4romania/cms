<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;

class Page extends Model implements Sortable
{
    use HasBlocks, HasTranslation, HasSlug, HasMedias, HasRevisions, HasPosition;

    /** @var array<string> */
    protected $fillable = [
        'published',
        'title',
        'description',
        'position',
        'show_header',
        'publish_start_date',
        'publish_end_date',
    ];

    /** @var array<string> */
    protected $casts = [
        'show_header' => 'bool',
    ];

    /**
     * Required when using the HasTranslation trait
     *
     * @var array<string>
     */
    public $translatedAttributes = [
        'title',
        'description',
        'active',
    ];

    /**
     * Required when using the HasSlug trait
     *
     * @var array<string>
     */
    public $slugAttributes = [
        'title',
    ];

    /**
     * Checkbox field names (published toggle is itself a checkbox)
     *
     * @var array<string>
     */
    public $checkboxes = [
        'published',
    ];

    /** @var array<string,int> */
    public $mediasParams = [
        'image' => [
            'default' => [
                [
                    'name' => 'default',
                ],
            ],
        ],
    ];
}
