<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models\Translations;

use A17\Twill\Models\Model;
use Code4Romania\Cms\Models\Post;

class PostTranslation extends Model
{
    protected $baseModuleModel = Post::class;
}
