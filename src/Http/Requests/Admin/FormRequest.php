<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Requests\Admin;

use A17\Twill\Http\Requests\Admin\Request;
use Code4Romania\Cms\Rules\OneEmailPerLine;

class FormRequest extends Request
{
    public function rulesForCreate(): array
    {
        return [];
    }

    public function rulesForUpdate(): array
    {
        return [
            'store'        => ['required', 'boolean'],
            'send'         => ['required', 'boolean'],
            'recipients'   => ['required_if:send,1', new OneEmailPerLine],
        ];
    }
}
