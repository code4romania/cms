@extends('twill::layouts.form', [
    'translateTitle' => false,
    'controlLanguagesPublication' => true,
    'contentFieldsetLabel' => 'Profile',
    'additionalFieldsets'  => [
        [
            'fieldset' => 'image',
            'label'    => __('admin.field.image'),
        ],
    ],
])

@section('contentFields')
    @formField('input', [
        'name'           => 'title',
        'label'          => __('admin.field.title'),
        'translated'     => true,
    ])

    @formField('wysiwyg', [
        'name'           => 'description',
        'label'          => __('admin.field.description'),
        'type'           => config('cms.editor.type'),
        'toolbarOptions' => config('cms.editor.toolbar'),
        'editSource'     => true,
        'translated'     => true,
    ])

    @foreach (['github', 'linkedin'] as $network)
        @formField('input', [
            'name'       => $network,
            'label'      => config("cms.social.networks.{$network}.name"),
            'prefix'     => config("cms.social.networks.{$network}.baseUrl"),
            'translated' => false,
        ])
    @endforeach

    @formField('browser', [
        'routePrefix' => 'people',
        'moduleName'  => 'cityLabs',
        'name'        => 'cityLab',
        'label'       => __('admin.cityLab'),
        'max'         => 1,
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
