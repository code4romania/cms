<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\ModuleRepository;
use Code4Romania\Cms\Models\Form;

class FormRepository extends ModuleRepository
{
    use HandleBlocks, HandleTranslations;

    public function __construct(Form $model)
    {
        $this->model = $model;
    }
}
