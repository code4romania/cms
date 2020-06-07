<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Repositories;

use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\ModuleRepository;
use Code4Romania\Cms\Models\CityLab;
use Code4Romania\Cms\Models\Person;

class PersonRepository extends ModuleRepository
{
    use HandleTranslations, HandleMedias;

    protected $browsers = [
        'cityLab' => [
            'routePrefix' => 'people',
            'titleKey'    => 'name',
        ],
    ];

    public function __construct(Person $model)
    {
        $this->model = $model;
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $scopes
     * @return \Illuminate\Database\Query\Builder
     */
    public function filter($query, array $scopes = [])
    {
        if (array_key_exists('cityLab', $scopes)) {
            $cityLab = CityLab::find($scopes['cityLab']);

            if ($cityLab) {
                return $cityLab->people();
            }
        }

        return parent::filter($query, $scopes);
    }
}
