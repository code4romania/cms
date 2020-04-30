<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\ModuleRepository;
use Code4Romania\Cms\Models\Menu;

class MenuRepository extends ModuleRepository
{
    use HandleBlocks, HandleTranslations, HandleSlugs;

    public function __construct(Menu $model)
    {
        $this->model = $model;
    }
}
