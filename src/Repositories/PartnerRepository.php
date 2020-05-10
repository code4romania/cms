<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Repositories;

use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\ModuleRepository;
use Code4Romania\Cms\Models\Partner;

class PartnerRepository extends ModuleRepository
{
    use HandleMedias;

    public function __construct(Partner $model)
    {
        $this->model = $model;
    }
}
