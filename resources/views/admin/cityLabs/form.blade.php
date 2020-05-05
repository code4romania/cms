@extends('twill::layouts.form', [
    'controlLanguagesPublication' => true,
    'additionalFieldsets'  => [
        [
            'fieldset' => 'image',
            'label'    => __('admin.field.image'),
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

    @formField('browser', [
        'routePrefix' => 'people',
        'moduleName'  => 'people',
        'name'        => 'people',
        'label'       => __('admin.people'),
        'note'        => trans_choice('admin.fieldNote.peopleUpTo', 100),
        'max'         => 100,
    ])
@endsection

@section('fieldsets')
    <a17-fieldset title="{{ __('admin.field.image') }}" id="image">
        @formField('medias', [
            'name'  => 'image',
            'label' => false,
        ])
    </a17-fieldset>
@endsection
