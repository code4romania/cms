<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\ModuleRepository;
use Code4Romania\Cms\Models\Page;
use Illuminate\Support\Facades\DB;

class PageRepository extends ModuleRepository
{
    use HandleBlocks, HandleTranslations, HandleSlugs, HandleMedias, HandleRevisions;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    /**
     * @param array<int,string> $ids
     * @return void
     */
    public function setNewOrder($ids): void
    {
        DB::transaction(function () use ($ids): void {
            Page::saveTreeFromIds($ids);
        }, 3);
    }
}
