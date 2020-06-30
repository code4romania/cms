<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Requests\Front;

use Code4Romania\Cms\Models\Form;
use Illuminate\Foundation\Http\FormRequest as Request;

class FormRequest extends Request
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
        return Form::query()
            ->findOrFail($this->route('id'))
            ->getFieldsColumn('validation');
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return Form::query()
            ->findOrFail($this->route('id'))
            ->getFieldsColumn('label');
    }
}
