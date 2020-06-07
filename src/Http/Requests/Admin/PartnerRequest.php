<?php

namespace Code4Romania\Cms\Http\Requests\Admin;

use A17\Twill\Http\Requests\Admin\Request;

class PartnerRequest extends Request
{
    public function rulesForCreate(): array
    {
        return [];
    }

    public function rulesForUpdate(): array
    {
        return [
            'website' => ['nullable', 'url'],
        ];
    }
}
