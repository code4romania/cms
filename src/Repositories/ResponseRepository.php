<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Repositories;

use A17\Twill\Repositories\ModuleRepository;
use Code4Romania\Cms\Models\Response;

class ResponseRepository extends ModuleRepository
{
    public function __construct(Response $model)
    {
        $this->model = $model;
    }
}
