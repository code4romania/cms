<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class PageController extends ModuleController
{
    /**
     * @var string
     */
    protected $moduleName = 'pages';

    /**
     * @var string
     */
    protected $permalinkBase = '';

    /**
     * @var string
     */
    protected $previewView = 'front.pages.show';
}
