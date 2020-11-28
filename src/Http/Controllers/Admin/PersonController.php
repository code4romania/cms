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

    /** @var string */
    protected $previewView = 'front.people.show';

    /** @var array<string> */
    protected $indexWith = [
        'cityLab',
    ];

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
        'cityLab' => [
            'title'   => 'City Lab',
            'field'   => 'cityLab',
            'present' => true,
        ],
    ];

    /** @var array<string> */
    protected $filters = [
        'cityLab' => 'cityLab',
    ];

    /** @var array<string> */
    protected $defaultFilters = [
        'search' => '%name',
    ];

    /** @param Request $request */
    protected function indexData($request): array
    {
        return [
            'translateTitle' => false,
            'cityLabList'    => app(CityLabRepository::class)->listAll('name'),
        ];
    }
}
