<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models\Translations;

use A17\Twill\Models\Model;

class PageTranslation extends Model
{
    /**
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'description',
        'active',
        'locale',
    ];
}
