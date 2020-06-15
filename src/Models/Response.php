<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models;

use Code4Romania\Cms\Models\BaseModel;
use Code4Romania\Cms\Presenters\ResponsePresenter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Response extends BaseModel
{
    /** @var array<string> */
    protected $with = [
        'form',
    ];

    /** @var array<string> */
    protected $casts = [
        'data' => 'array',
    ];

    /** @var Presenter */
    protected $presenterAdmin = ResponsePresenter::class;

    /** @var array<string> */
    protected $fillable = [
        'form_id',
        'data',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function attachLabelsToData(array $sections): array
    {
        $labels = $this->form->getFieldsColumn('label');

        $result = [];
        foreach ($sections as $sectionIndex => $section) {
            $result[$sectionIndex] = [];
            foreach ($section as $fieldIndex => $field) {
                $result[$sectionIndex][$fieldIndex] = [
                    'label' => $labels["fields.${sectionIndex}.${fieldIndex}"] ?? null,
                    'value' => $field,
                ];
            }
        }

        return $result;
    }
}
