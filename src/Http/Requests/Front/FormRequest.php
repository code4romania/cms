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
        return $this->getFieldsColumn('validation');
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return $this->getFieldsColumn('label');
    }

    /**
     * Get common params by name for all fields. Acts like array_column.
     *
     * @param string $column
     * @return array
     */
    protected function getFieldsColumn(string $column): array
    {
        return Form::query()
            ->findOrFail($this->route('id'))
            ->getFieldsBySection()
            ->flatMap(function ($section, $sectionIndex) use ($column) {
                return $section['fields']
                    ->mapWithKeys(function ($field, $fieldIndex) use ($sectionIndex, $column) {
                        return ["fields.${sectionIndex}.${fieldIndex}" => $field[$column]];
                    });
            })
            ->toArray();
    }
}
