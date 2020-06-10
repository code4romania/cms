@extends('twill::layouts.form', [
    'disableContentFieldset' => true,
    'additionalFieldsets' => [
        [
            'fieldset' => 'database',
            'label'    => __('form.database'),
        ],
        [
            'fieldset' => 'emails',
            'label'    => __('form.emails'),
        ],
        [
            'fieldset' => 'fields',
            'label'    => __('form.fields'),
        ],
    ],
])

@section('fieldsets')
    <a17-fieldset title="{{ __('form.database') }}" id="database">
        @formField('select', [
            'name'       => 'store',
            'label'      => __('form.submission.store'),
            'required'   => true,
            'default'    => 1,
            'unpack'     => true,
            'options'    => [
                [
                    'value' => 1,
                    'label' => __('form.yes'),
                ],
                [
                    'value' => 0,
                    'label' => __('form.no'),
                ],
            ],
        ])
    </a17-fieldset>

    <a17-fieldset title="{{ __('form.emails') }}" id="emails">
        @formField('select', [
            'name'       => 'send',
            'label'      => __('form.submission.send'),
            'required'   => true,
            'default'    => 0,
            'unpack'     => true,
            'options'    => [
                [
                    'value' => 1,
                    'label' => __('form.yes'),
                ],
                [
                    'value' => 0,
                    'label' => __('form.no'),
                ],
            ],
        ])

        @component('twill::partials.form.utils._connected_fields', [
            'fieldName'       => 'send',
            'fieldValues'     => 1,
            'renderForBlocks' => false,
            'keepAlive'       => true,
        ])
            @formField('input', [
                'name'        => 'recipients',
                'type'        => 'textarea',
                'label'       => __('admin.field.recipients'),
                'note'        => __('admin.fieldNote.recipients'),
            ])
        @endcomponent

        @formField('select', [
            'name'       => 'confirm',
            'label'      => __('form.submission.confirm'),
            'required'   => true,
            'default'    => 0,
            'unpack'     => true,
            'options'    => [
                [
                    'value' => 1,
                    'label' => __('form.yes'),
                ],
                [
                    'value' => 0,
                    'label' => __('form.no'),
                ],
            ],
        ])

    </a17-fieldset>

    <a17-fieldset title="{{ __('form.fields') }}" id="fields">
        @formField('block_editor', [
            'withoutSeparator' => true,
            'group' => 'form',
        ])
    </a17-fieldset>
@endsection
