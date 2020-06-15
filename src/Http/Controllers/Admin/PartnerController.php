<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class PartnerController extends ModuleController
{
    /** @var string */
    protected $moduleName = 'partners';

    /** @var string */
    protected $titleColumnKey = 'name';

    /** @var string */
    protected $titleFormKey = 'name';

    /** @var string */
    protected $titleInDashboard = 'name';

    /** @var array<string> */
    protected $indexWith = [
        'medias',
    ];

    /** @var array<string> */
    protected $indexOptions = [
        'permalink' => false,
        'reorder'   => true,
    ];

    /** @var array */
    protected $indexColumns = [
        'image' => [
            'thumb' => true,
            'field' => 'image',
            'variant' => [
                'role' => 'logo',
                'crop' => 'default',
            ],
        ],
        'name' => [
            'title' => 'Name',
            'field' => 'name',
            'sort' => true,
        ],
        'website' => [
            'title' => 'Website',
            'field' => 'website',
        ],
    ];
}
