<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Repositories;

use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\ModuleRepository;
use Code4Romania\Cms\Models\Category;

class CategoryRepository extends ModuleRepository
{
    use HandleTranslations, HandleSlugs;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }
}
