<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Requests\Admin;

use A17\Twill\Http\Requests\Admin\Request;

class MenuRequest extends Request
{
    public function rulesForCreate(): array
    {
        return [];
    }

    public function rulesForUpdate(): array
    {
        return [];
    }
}
