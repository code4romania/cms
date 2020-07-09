@php
    $additionalFieldsets = [
        [
            'fieldset' => 'notice',
            'label'    => __('admin.settings.globalNotice'),
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
    'additionalFieldsets' => $additionalFieldsets,
])

@section('contentFields')
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

    @formField('select', [
        'name'         => 'frontPage',
        'label'        => __('admin.field.frontPage'),
        'native'       => true,
        'max'          => 1,
        'options'      => Code4Romania\Cms\Models\Page::query()
            ->with('translation:id,page_id,title')
            ->get('id')
            ->mapWithKeys(fn($page) => [ $page->id => $page->title ]),
    ])
@endsection

@section('fieldsets')
    <a17-fieldset title="{{ __('admin.settings.globalNotice') }}" id="notice">
        @formField('select', [
            'name'       => 'notice_enabled',
            'label'      => __('admin.field.show'),
            'default'    => 0,
            'unpack'     => true,
            'options'    => [
                [
                    'value' => 1,
                    'label' => 'Yes',
                ],
                [
                    'value' => 0,
                    'label' => 'No',
                ],
            ],
        ])

        @formField('select', [
            'name'       => 'notice_color',
            'label'      => __('admin.field.background'),
            'required'   => true,
            'default'    => 'none',
            'options'    => collect(config('cms.colors'))
                ->map(function($key, $index) {
                    return [
                        'value' => $index,
                        'label' => ucfirst($key),
                    ];
                })->toArray(),
        ])

        @include('admin.utils.ckeditor', [
            'name'       => 'notice_content',
            'label'      => __('admin.field.content'),
            'translated' => true,
        ])
    </a17-fieldset>

    <a17-fieldset title="{{ __('admin.blog') }}" id="blog">
        @formField('input', [
            'name'       => 'blogTitle',
            'label'      => __('admin.field.title'),
            'maxlength'  => 100,
            'translated' => true,
        ])

        @formField('input', [
            'name'       => 'blogDescription',
            'label'      => __('admin.field.description'),
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
