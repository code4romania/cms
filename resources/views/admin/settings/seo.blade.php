@php
    $additionalFieldsets = [
        [
            'fieldset' => 'global',
            'label'    => __('global'),
        ],
    ];

    if (config('cms.enabled.people', false)) {
        $additionalFieldsets[] = [
            'fieldset' => 'city-labs',
            'label'    => __('admin.cityLabs'),
        ];
    }
@endphp

@extends('twill::layouts.settings', [
    'customTitle'            => 'SEO Settings',
    'disableContentFieldset' => true,
    'additionalFieldsets'    => $additionalFieldsets,
])

@section('fieldsets')
    <a17-fieldset title="{{ __('global') }}" id="global">
        @formField('input', [
            'name'       => 'siteTitle',
            'label'      => __('admin.field.siteTitle'),
            'maxlength'  => 100,
            'translated' => true,
        ])

        @formField('input', [
            'name'       => 'siteDescription',
            'label'      => __('admin.field.siteDescription'),
            'type'       => 'textarea',
            'maxlength'  => 170,
            'translated' => true,
        ])
    </a17-fieldset>

    @if (config('cms.enabled.people', false))
        <a17-fieldset title="{{ __('admin.cityLabs') }}" id="city-labs">
            @formField('input', [
                'name'       => 'cityLabsTitle',
                'label'      => __('admin.field.title'),
                'maxlength'  => 100,
                'translated' => true,
            ])

            @formField('input', [
                'name'       => 'cityLabsDescription',
                'label'      => __('admin.field.description'),
                'type'       => 'textarea',
                'maxlength'  => 170,
                'translated' => true,
            ])
        </a17-fieldset>
    @endif
@endsection
