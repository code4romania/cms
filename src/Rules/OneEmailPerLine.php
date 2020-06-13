<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class OneEmailPerLine implements Rule
{
    protected $rules = [
        'email' => ['required', 'email'],
    ];

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $emails = preg_split('/\r\n|\r|\n/', $value);

        foreach ($emails as $email) {
            if (Validator::make(['email' => $email], $this->rules)->fails()) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return __('validation.email');
    }
}
