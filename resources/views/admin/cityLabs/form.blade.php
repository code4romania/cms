@extends('twill::layouts.form', [
    'controlLanguagesPublication' => true,
    'additionalFieldsets'  => [
        [
            'fieldset' => 'people',
            'label'    => __('admin.people'),
        ],
    ],
])


@section('contentFields')
    @formField('wysiwyg', [
        'name'           => 'description',
        'label'          => __('admin.field.description'),
        'type'           => config('cms.editor.type'),
        'toolbarOptions' => config('cms.editor.toolbar'),
        'editSource'     => true,
        'translated'     => true,
    ])

    @formField('medias', [
        'name'  => 'image',
        'label' => __('admin.field.image'),
    ])
@endsection

@section('fieldsets')
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
