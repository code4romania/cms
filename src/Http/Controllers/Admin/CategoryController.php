<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Admin;

class CategoryController extends ModuleController
{
    /** @var string */
    protected $moduleName = 'categories';

    /** @var string */
    protected $permalinkBase = 'blog/categories';

    /** @var array<string> */
    protected $indexOptions = [
        'editInModal' => false,
        'publish'     => false,
    ];

    /** @var array<string> */
    protected $indexWith = [
        'translations',
    ];

    /** @var array<string> */
    protected $indexForm = [
        'translations',
    ];
}
