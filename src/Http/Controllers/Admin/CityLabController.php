<?php

namespace Code4Romania\Cms\Http\Controllers\Admin;

class CityLabController extends ModuleController
{
    /** @var string */
    protected $moduleName = 'cityLabs';

    /** @var string */
    protected $titleColumnKey = 'name';

    /** @var string */
    protected $titleFormKey = 'name';

    /** @var string */
    protected $titleInDashboard = 'name';

    /** @var string */
    protected $permalinkBase = 'city-labs';

    /** @var array<string> */
    protected $indexOptions = [];

    /** @var array */
    protected $indexColumns = [
        'image' => [
            'thumb' => true,
            'field' => 'image',
            'variant' => [
                'role' => 'image',
                'crop' => 'default',
            ],
        ],
        'name' => [
            'title' => 'Name',
            'field' => 'name',
            'sort'  => true,
        ],
    ];

    /** @var array */
    protected $browserColumns = [
        'title' => [
            'title' => 'Name',
            'field' => 'name',
        ],
    ];
}
