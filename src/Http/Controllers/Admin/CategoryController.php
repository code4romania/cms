<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class CategoryController extends ModuleController
{
    /** @var string */
    protected $moduleName = 'categories';

    /** @var string */
    protected $permalinkBase = 'blog/categories';

    /** @var array<string> */
    protected $indexOptions = [
        'editInModal' => true,
        'publish'     => false,
    ];
}
