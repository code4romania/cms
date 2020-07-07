<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasTranslation;
use Code4Romania\Cms\Models\BaseModel;
use Code4Romania\Cms\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

class Post extends BaseModel
{
    use HasBlocks, HasTranslation, HasSlug, HasMedias, HasRevisions;

    /** @var array<string> */
    protected $with = [
        'categories',
    ];

    /** @var array<string> */
    protected $casts = [
        'publish_start_date' => 'datetime',
        'publish_end_date'   => 'datetime',
    ];

    protected $fillable = [
        'published',
        'title',
        'description',
        'author',
        'publish_start_date',
        'publish_end_date',
    ];

    public $translatedAttributes = [
        'title',
        'description',
        'active',
    ];

    public $slugAttributes = [
        'title',
    ];

    /** @var array<string,int> */
    public $mediasParams = [
        'image' => [
            'default' => [
                [
                    'name'  => 'default',
                    'ratio' => 2 / 1,
                ],
            ],
        ],
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function getDateAttribute(): Carbon
    {
        return ($this->publish_start_date ?? $this->created_at);
    }
}
