<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Requests\Front;

use Code4Romania\Cms\Helpers\MailchimpHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsletterSubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'list'  => ['required', Rule::in(MailchimpHelper::getListsCached()->pluck('id'))],
        ];
    }
}
