<?php

namespace Code4Romania\Cms\Http\Controllers\Admin;

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

    /** @var array */
    protected $indexColumns = [
        'title' => [
            'title' => 'Title',
            'field' => 'title',
            'sort'  => true,
        ],
        'location' => [
            'title' => 'Location',
            'field' => 'location',
        ],
    ];
}
