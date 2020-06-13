<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasTranslation;
use Code4Romania\Cms\Models\BaseModel;
use Code4Romania\Cms\Presenters\FormPresenter;
use Code4Romania\Cms\Traits\HasFormFields;

class Form extends BaseModel
{
    use HasBlocks, HasTranslation, HasFormFields;

    /** @var Presenter */
    protected $presenter = FormPresenter::class;

    protected $fillable = [
        'published',
        'title',
        'store',
        'send',
        'recipients',
        'confirm',
    ];

    public $translatedAttributes = [
        'title',
        'active',
    ];
}
