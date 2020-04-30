<?php

namespace Code4Romania\Cms\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class MenuController extends ModuleController
{
    protected $moduleName = 'menus';

    protected $indexOptions = [
        'permalink'   => false,
        'editInModal' => false,
        'reorder'     => false,
    ];

    /**
     * Disable the content editor (full screen block editor).
     *
     * @var bool
     */
    protected $disableEditor = true;
}
