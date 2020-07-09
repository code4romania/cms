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

    @include('admin.utils.ckeditor', [
        'name'       => 'description',
        'label'      => __('admin.field.description'),
        'translated' => true,
    ])

    @foreach (['github', 'linkedin'] as $network)
        @formField('input', [
            'name'       => $network,
            'label'      => config("cms.social.networks.{$network}.name"),
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
