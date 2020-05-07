<?php

namespace Code4Romania\Cms\Repositories;

use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\ModuleRepository;
use Code4Romania\Cms\Models\CityLab;

class CityLabRepository extends ModuleRepository
{
    use HandleTranslations, HandleSlugs, HandleMedias, HandleRevisions;

    protected $browsers = [
        'people' => [
            'routePrefix' => 'people',
            'titleKey'    => 'name',
        ],
    ];

    public function __construct(CityLab $model)
    {
        $this->model = $model;
    }
}
