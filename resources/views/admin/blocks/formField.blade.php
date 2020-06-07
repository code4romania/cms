@formField('input', [
    'name'           => 'label',
    'label'          => __('admin.field.label'),
    'type'           => 'text',
    'required'       => true,
    'translated'     => true,
])

@formField('input', [
    'name'           => 'help',
    'label'          => 'Help text',
    'note'           => __('admin.fieldNote.infoUser'),
    'type'           => 'text',
    'required'       => false,
    'translated'     => true,
])

@formField('select', [
    'name'       => 'type',
    'label'      => __('admin.field.type'),
    'default'    => collect(config('cms.form.fields'))->first(),
    'options'    => collect(config('cms.form.fields'))
        ->map(function($field) {
            return [
                'value' => $field,
                'label' => __("form.field.$field"),
            ];
        })->toArray(),
])

@formField('select', [
    'name'       => 'required',
    'label'      => __('form.required'),
    'default'    => false,
    'options'    => [
        [
            'value' => false,
            'label' => __('form.no'),
        ],
        [
            'value' => true,
            'label' => __('form.yes'),
        ],
    ],
])

@component('twill::partials.form.utils._connected_fields', [
    'fieldName'       => 'type',
    'fieldValues'     => 'text',
    'renderForBlocks' => true,
    'keepAlive'       => true,
])
    @formField('input', [
        'name'           => 'maxLength',
        'label'          => __('form.label.maxLength'),
        'note'           => __('form.note.maxLength'),
        'type'           => 'number',
        'required'       => false,
        'translated'     => false,
        'default'        => '',
    ])
@endcomponent

@component('twill::partials.form.utils._connected_fields', [
    'fieldName'       => 'type',
    'fieldValues'     => 'textarea',
    'renderForBlocks' => true,
    'keepAlive'       => true,
])
    @formField('input', [
        'name'           => 'maxLength',
        'label'          => __('form.label.maxLength'),
        'note'           => __('form.note.maxLength'),
        'type'           => 'number',
        'required'       => false,
        'translated'     => false,
        'default'        => '',
    ])
@endcomponent

@component('twill::partials.form.utils._connected_fields', [
    'fieldName'       => 'type',
    'fieldValues'     => 'number',
    'renderForBlocks' => true,
])
    @formField('input', [
        'name'           => 'minValue',
        'label'          => __('form.label.minValue'),
        'type'           => 'number',
        'required'       => false,
        'translated'     => false,
        'default'        => '',
    ])

    @formField('input', [
        'name'           => 'maxValue',
        'label'          => __('form.label.maxValue'),
        'type'           => 'number',
        'required'       => false,
        'translated'     => false,
        'default'        => '',
    ])
@endcomponent

@component('twill::partials.form.utils._connected_fields', [
    'fieldName'       => 'type',
    'fieldValues'     => 'date',
    'renderForBlocks' => true,
])
    @formField('date_picker', [
        'name'           => 'minDate',
        'label'          => __('form.label.minDate'),
        'placeholder'    => __('form.note.selectDate'),
        'required'       => false,
        'withTime'       => false,
        'allowClear'     => true,
    ])

    @formField('date_picker', [
        'name'           => 'maxDate',
        'label'          => __('form.label.maxDate'),
        'placeholder'    => __('form.note.selectDate'),
        'required'       => false,
        'withTime'       => false,
        'allowClear'     => true,
    ])
@endcomponent

@component('twill::partials.form.utils._connected_fields', [
    'fieldName'       => 'type',
    'fieldValues'     => 'checkbox',
    'renderForBlocks' => true,
])
    @formField('input', [
        'name'           => 'checkboxLabel',
        'label'          => __('form.label.checkboxLabel'),
        'note'           => __('form.note.checkboxLabel'),
        'type'           => 'text',
        'required'       => false,
        'translated'     => true,
    ])
@endcomponent
