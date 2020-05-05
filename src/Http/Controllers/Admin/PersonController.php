<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Admin;

use Code4Romania\Cms\Repositories\CityLabRepository;
use Illuminate\Http\Request;

class PersonController extends ModuleController
{
    /** @var string */
    protected $moduleName = 'people';

    /** @var string */
    protected $titleColumnKey = 'name';

    /** @var string */
    protected $titleFormKey = 'name';

    /** @var string */
    protected $titleInDashboard = 'name';

    /** @var array<string> */
    protected $indexOptions = [
        'permalink' => false,
    ];

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
        'citylab' => [
            'title'   => 'City Lab',
            'field'   => 'cityLab',
            'present' => true,
        ],
    ];

    /** @var array<string> */
    protected $filters = [
        'citylab' => 'cityLab',
    ];

    /** @param Request $request */
    protected function indexData($request): array
    {
        return [
            'translateTitle' => false,
            'citylabList'    => app(CityLabRepository::class)->listAll('name'),
        ];
    }
}
