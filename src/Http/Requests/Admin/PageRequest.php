<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Requests\Admin;

use A17\Twill\Http\Requests\Admin\Request;

class PageRequest extends Request
{
    /**
     * @return array<string>
     */
    public function rulesForCreate(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    public function rulesForUpdate(): array
    {
        return [];
    }
}
