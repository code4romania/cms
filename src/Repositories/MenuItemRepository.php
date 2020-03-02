<?php

namespace Code4Romania\Cms\Repositories;

use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\ModuleRepository;
use Code4Romania\Cms\Models\MenuItem;
use Illuminate\Support\Facades\DB;

class MenuItemRepository extends ModuleRepository
{
    use HandleTranslations;

    public function __construct(MenuItem $model)
    {
        $this->model = $model;
    }

    public function setNewOrder($ids)
    {
        DB::transaction(function () use ($ids) {
            MenuItem::saveTreeFromIds($ids);
        }, 3);
    }
}
