@extends('twill::layouts.form', [
    'contentFieldsetLabel' => __('admin.field.summary'),
    'additionalFieldsets' => [
        [
            'fieldset' => 'content-blocks',
            'label'    => __('admin.field.content'),
        ],
    ],
])

@section('contentFields')
    @formField('checkbox', [
        'name'    => 'show_header',
        'label'   => __('admin.field.showHeader'),
        'default' => true,
    ])

    @include('admin.utils.ckeditor', [
        'name'       => 'description',
        'label'      => __('admin.field.description'),
        'translated' => true,
    ])
@stop


@section('fieldsets')
    <a17-fieldset title="{{ __('admin.field.content') }}" id="content-blocks">
        @formField('block_editor', [
            'withoutSeparator' => true,
            'group' => 'content',
        ])
    </a17-fieldset>
@stop
