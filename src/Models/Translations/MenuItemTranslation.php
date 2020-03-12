<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models\Translations;

use A17\Twill\Models\Model;

class MenuItemTranslation extends Model
{
    protected $fillable = [
        'label',
        'active',
        'locale',
    ];
}
