<?php

namespace Code4Romania\Cms\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasTranslation;
use Code4Romania\Cms\Models\BaseModel;

class Form extends BaseModel
{
    use HasBlocks, HasTranslation;

    protected $fillable = [
        'published',
        'title',
        'description',
    ];

    public $translatedAttributes = [
        'title',
        'active',
    ];
}
