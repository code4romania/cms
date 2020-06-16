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
    @formField('input', [
        'name'           => 'description',
        'type'           => 'textarea',
        'label'          => __('admin.field.description'),
        'translated'     => true,
    ])

    @formField('medias', [
        'name'           => 'image',
        'label'        => __('admin.field.image'),
        'max'          => 1,
        'required'     => true,
        'withVideoUrl' => false,
        'withAddInfo'  => false,
        'withCaption'  => false,
    ])

    @formField('input', [
        'name'        => 'author',
        'type'        => 'text',
        'label'       => __('admin.field.author'),
    ])

    @formField('browser', [
        'label'       => __('admin.categories'),
        'routePrefix' => 'blog',
        'name'        => 'categories',
        'moduleName'  => 'categories',
        'sortable'    => false,
        'max'         => 5,
    ])
@endsection


@section('fieldsets')
    <a17-fieldset title="{{ __('admin.field.content') }}" id="content-blocks">
        @formField('block_editor', [
            'withoutSeparator' => true,
            'group' => 'content',
        ])
    </a17-fieldset>
@endsection
