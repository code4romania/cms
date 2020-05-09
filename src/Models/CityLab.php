<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasTranslation;
use Code4Romania\Cms\Models\BaseModel;
use Code4Romania\Cms\Models\Person;

class CityLab extends BaseModel
{
    use HasTranslation, HasSlug, HasMedias, HasRevisions;

    protected $with = [
        'translations',
        'medias',
    ];

    /** @var array<string> */
    protected $fillable = [
        'published',
        'name',
        'description',
        'position',
    ];

    /** @var array<string> */
    public $translatedAttributes = [
        'name',
        'description',
        'active',
    ];

    /**
     * Required when using the HasSlug trait
     *
     * @var array<string>
     */
    public $slugAttributes = [
        'name',
    ];

    /** @var array<string,int> */
    public $mediasParams = [
        'image' => [
            'default' => [
                [
                    'name' => 'default',
                    'ratio' => 1,
                ],
            ],
        ],
    ];

    public function getTitleInBrowserAttribute(): string
    {
        return $this->name;
    }

    public function people()
    {
        return $this->morphToMany(Person::class, 'personable');
    }
}
