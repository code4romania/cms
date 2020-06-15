<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class PostController extends ModuleController
{
    /** @var string */
    protected $moduleName = 'posts';

    /** @var string */
    protected $permalinkBase = 'blog';
}
