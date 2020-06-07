@extends('twill::layouts.settings', [
    'additionalFieldsets' => [
        [
            'fieldset' => 'notice',
            'label'    => __('admin.settings.globalNotice'),
        ],
    ],
])

@php
    $allPages = app( config('twill.namespace') . '\Models\Page')
        ->with([
            'translation' => function ($query) {
                $query->select('id', 'title');
            }
        ])
        ->get('id', 'translation')
        ->map(function($item) {
            return [
                'value' => $item->id,
                'label' => $item->title,
            ];
        })
        ->toArray();
@endphp

@section('contentFields')
    @formField('select', [
        'name'         => 'frontPage',
        'label'        => __('admin.field.frontPage'),
        'native'       => true,
        'max'          => 1,
        'options'      => $allPages,
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

        @formField('wysiwyg', [
            'name'           => 'notice_content',
            'label'          => __('admin.field.content'),
            'type'           => config('cms.editor.type'),
            'toolbarOptions' => config('cms.editor.toolbar'),
            'translated'     => true,
            'editSource'     => true,
            'maxlength'      => 200,
        ])
    </a17-fieldset>
@endsection
