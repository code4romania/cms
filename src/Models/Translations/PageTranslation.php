<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models\Translations;

use A17\Twill\Models\Model;
use Code4Romania\Cms\Models\Page;

class PageTranslation extends Model
{
    protected $baseModuleModel = Page::class;
}
