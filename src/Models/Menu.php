<?php

namespace Code4Romania\Cms\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Model;

class Menu extends Model
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
