<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Presenters;

use A17\Twill\Models\Block;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class FormPresenter extends Presenter
{
    public function getFieldsBySection(): Collection
    {
        return $this->model->blocks
            ->where('type', 'formSection')
            ->where('parent_id', null)
            ->map(function ($section): array {
                return [
                    'title' => $section->translatedInput('name'),
                    'description' => $section->translatedInput('description'),
                    'fields' => $this->model->blocks
                        ->where('type', 'formField')
                        ->where('parent_id', $section->id)
                        ->map(fn ($field) => $this->getFieldParams($field))
                        ->values(),
                ];
            })->values();
    }

    public function getFieldParams(Block $field): array
    {
        $params = $this->getCommonFieldParams($field);

        $method = Str::camel("get_{$params['type']}_field_params");

        if (!method_exists($this, $method)) {
            $method = 'getTextFieldParams';
        }

        return $this->$method($field, $params);

        switch ($params['type']) {
            case 'date':
                return $this->getDateFieldParams($field, $params);
                break;

            case 'file':
                return $this->getFileFieldParams($field, $params);
                break;

            case 'number':
                return $this->getNumberFieldParams($field, $params);
                break;

            case 'email':
                return $this->getEmailFieldParams($field, $params);
                break;

            case 'url':
                return $this->getUrlFieldParams($field, $params);
                break;

            case 'checkbox':
                return $this->getCheckboxFieldParams($field, $params);
                break;

            default:
                return $this->getTextFieldParams($field, $params);
                break;
        }
    }

    public function getValidationRules(): array
    {
        $rules = [];

        foreach ($this->getFieldsBySection($sections) as $sectionIndex => $section) {
            foreach ($section['fields'] as $fieldIndex => $field) {
                $rules["data.${sectionIndex}.${fieldIndex}.label"] = [];
                $rules["data.${sectionIndex}.${fieldIndex}.value"] = $field['validation'];
            }
        }

        return $rules;
    }

    private function getCommonFieldParams($field): array
    {
        $required = (bool) $field->input('required');

        return [
            'type'       => $field->input('type'),
            'label'      => $field->translatedInput('label'),
            'help'       => $field->translatedInput('help'),
            'required'   => $required,
            'validation' => [
                $required ? 'required' : 'nullable',
            ],
        ];
    }

    private function getDateFieldParams(Block $field, array $params): array
    {
        if ($field->input('minDate')) {
            $minDate = Carbon::parse($field->input('minDate'));
        } else {
            $minDate = Carbon::today()->subYears(5);
        }

        if ($field->input('maxDate')) {
            $maxDate = Carbon::parse($field->input('maxDate'));
        } else {
            $maxDate = Carbon::today()->addYears(5);
        }

        $params['minDate'] = $minDate->toIso8601String();
        $params['maxDate'] = $maxDate->toIso8601String();

        if (Carbon::today()->greaterThan($params['minDate'])) {
            $params['focusedDate'] = Carbon::today()->toIso8601String();
        } else {
            $params['focusedDate'] = $params['minDate'];
        }

        $params['validation'][] = 'date';
        $params['validation'][] = sprintf('after_or_equal:%s', $minDate->format('Y-m-d'));
        $params['validation'][] = sprintf('before_or_equal:%s', $maxDate->format('Y-m-d'));

        return $params;
    }

    private function getNumberFieldParams(Block $field, array $params): array
    {
        $params['minValue'] = intval($field->input('minValue')) ?: false;
        $params['maxValue'] = intval($field->input('maxValue')) ?: false;

        $params['validation'][] = 'integer';

        if ($params['minValue']) {
            $params['validation'][] = sprintf('min:%d', $params['minValue']);
        }

        if ($params['maxValue']) {
            $params['validation'][] = sprintf('max:%d', $params['maxValue']);
        }

        return $params;
    }

    private function getEmailFieldParams(Block $field, array $params): array
    {
        $params['validation'][] = 'email';

        return $params;
    }

    private function getFileFieldParams(Block $field, array $params): array
    {
        $params['maxSize'] = intval($field->input('maxSize')) ?: false;
        $params['inputLabel'] = __('form.choose');

        $params['validation'][] = 'file';

        if ($params['maxSize']) {
            $params['validation'][] = sprintf('min:%d', $params['maxSize'] * 1024);
        }

        return $params;
    }

    private function getUrlFieldParams(Block $field, array $params): array
    {
        $params['validation'][] = 'url';

        return $params;
    }

    private function getCheckboxFieldParams(Block $field, array $params): array
    {
        $params['validation'][] = 'boolean';
        $params['checkboxLabel'] = $field->translatedInput('checkboxLabel');

        return $params;
    }

    private function getTextFieldParams(Block $field, array $params): array
    {
        $params['maxLength'] = intval($field->input('maxLength')) ?: false;

        $params['validation'][] = 'string';

        if ($params['maxLength']) {
            $params['validation'][] = sprintf('max:%d', $params['maxLength']);
        }

        return $params;
    }
}
