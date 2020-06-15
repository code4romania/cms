<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasTranslation;
use Code4Romania\Cms\Models\BaseModel;

class Menu extends BaseModel
{
    use HasBlocks, HasTranslation;

    protected $fillable = [
        'published',
        'title',
        'description',
        'location',
    ];

    public $translatedAttributes = [
        'title',
        'active',
    ];
}
