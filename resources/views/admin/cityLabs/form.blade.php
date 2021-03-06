@extends('twill::layouts.form', [
    'disableContentFieldset' => true,
    'additionalFieldsets'  => [
        [
            'fieldset' => 'summary',
            'label'    => __('admin.field.summary'),
        ],
        [
            'fieldset' => 'content',
            'label'    => __('admin.field.content'),
        ],
        [
            'fieldset' => 'people',
            'label'    => __('admin.people'),
        ],
    ],
])

@section('fieldsets')
    <a17-fieldset title="{{ __('admin.field.summary') }}" id="summary">
        @formField('medias', [
            'name'  => 'image',
            'label' => __('admin.field.image'),
        ])

        @include('admin.utils.ckeditor', [
            'name'       => 'description',
            'label'      => __('admin.field.description'),
            'translated' => true,
        ])
    </a17-fieldset>

    <a17-fieldset title="{{ __('admin.field.content') }}" id="content">
        @formField('block_editor', [
            'withoutSeparator' => true,
            'group' => 'content',
        ])
    </a17-fieldset>

    <a17-fieldset title="{{ __('admin.people') }}" id="people">
        @formField('browser', [
            'routePrefix' => 'people',
            'moduleName'  => 'people',
            'name'        => 'people',
            'label'       => false,
            'note'        => trans_choice('admin.fieldNote.peopleUpTo', 100),
            'max'         => 100,
        ])
    </a17-fieldset>
@endsection
