<?php

namespace Code4Romania\Cms\Http\Controllers\Admin;

class FormController extends ModuleController
{
    protected $moduleName = 'forms';

    /** @var array<string> */
    protected $formWith = [
        'blocks.files',
        'blocks.medias',
    ];

    /** @var array<string> */
    protected $indexOptions = [
        'permalink'   => false,
        'editInModal' => false,
        'reorder'     => false,
    ];
}
