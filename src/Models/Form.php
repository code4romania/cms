<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Block;
use Code4Romania\Cms\Models\BaseModel;
use Code4Romania\Cms\Models\Response;
use Code4Romania\Cms\Presenters\FormPresenter;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Form extends BaseModel
{
    use HasBlocks, HasTranslation;

    protected $casts = [
        'store'   => 'boolean',
        'send'    => 'boolean',
        'confirm' => 'boolean',
    ];

    /** @var Presenter */
    protected $presenter = FormPresenter::class;

    protected $fillable = [
        'published',
        'title',
        'store',
        'send',
        'recipients',
        'confirm',
    ];

    public $translatedAttributes = [
        'title',
        'active',
    ];

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }

    public function getSections(): Collection
    {
        return $this->blocks
            ->where('type', 'formSection')
            ->whereNull('parent_id')
            ->values();
    }

    public function getFields(Block $section): array
    {
        return [
            'title'       => $section->translatedInput('name'),
            'description' => $section->translatedInput('description'),
            'fields'      => $this->blocks
                ->where('type', 'formField')
                ->where('parent_id', $section->id)
                ->map(fn ($field) => $this->getFieldParams($field))
                ->values(),
        ];
    }

    public function getFieldsBySection()
    {
        return $this->getSections()
            ->map(fn ($section) => $this->getFields($section));
    }

    /**
     * Get common params by name for all fields. Acts like array_column.
     *
     * @param string $column
     * @return array
     */
    public function getFieldsColumn(string $column): array
    {
        return $this->getFieldsBySection()
            ->flatMap(function ($section, $sectionIndex) use ($column) {
                return $section['fields']
                    ->mapWithKeys(function ($field, $fieldIndex) use ($sectionIndex, $column) {
                        return ["fields.${sectionIndex}.${fieldIndex}" => $field[$column]];
                    });
            })
            ->toArray();
    }

    public function getFieldParams(Block $field): array
    {
        $params = $this->getCommonFieldParams($field);

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

            case 'text':
            case 'textarea':
            default:
                return $this->getTextFieldParams($field, $params);
                break;
        }
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
        $params['minDate'] = $field->input('minDate') ? Carbon::parse($field->input('minDate'))->format('Y-m-d') : null;
        $params['maxDate'] = $field->input('maxDate') ? Carbon::parse($field->input('maxDate'))->format('Y-m-d') : null;

        if (Carbon::today()->greaterThan($params['minDate'])) {
            $params['focusedDate'] = Carbon::today()->format('Y-m-d');
        } else {
            $params['focusedDate'] = $params['minDate'];
        }

        $params['validation'][] = 'date';

        if ($params['minDate']) {
            $params['validation'][] = sprintf('after_or_equal:%s', $params['minDate']);
        }

        if ($params['maxDate']) {
            $params['validation'][] = sprintf('before_or_equal:%s', $params['maxDate']);
        }

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
            $params['validation'][] = sprintf('max:%d', $params['maxSize'] * 1024);
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
        $params['minLength'] = intval($field->input('minLength')) ?: false;
        $params['maxLength'] = intval($field->input('maxLength')) ?: false;

        $params['validation'][] = 'string';

        if ($params['minLength']) {
            $params['validation'][] = sprintf('min:%d', $params['minLength']);
        }

        if ($params['maxLength']) {
            $params['validation'][] = sprintf('max:%d', $params['maxLength']);
        }

        return $params;
    }
}
