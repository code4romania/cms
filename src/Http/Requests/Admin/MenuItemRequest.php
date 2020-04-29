<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Requests\Admin;

use A17\Twill\Http\Requests\Admin\Request;
use Illuminate\Validation\Rule;

class MenuItemRequest extends Request
{
    public function rulesForCreate(): array
    {
        return $this->commonRules();
    }

    public function rulesForUpdate(): array
    {
        return $this->commonRules();
    }

    protected function commonRules(): array
    {
        return [
            'menu' => [
                'required',
                'string',
                Rule::in(config('cms.menu.locations')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'menu.in' => __('validation.admin.menuIn'),
        ];
    }
}
