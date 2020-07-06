@formField('input', [
    'name'           => 'title',
    'label'          => __('admin.field.title'),
    'translated'     => true,
])

@formField('input', [
    'name'           => 'subtitle',
    'label'          => __('admin.field.subtitle'),
    'translated'     => true,
])

@include('admin.utils.ckeditor', [
    'name'       => 'content',
    'label'      => __('admin.field.content'),
    'translated' => true,
])

@formField('select', [
    'name'       => 'button_color',
    'label'      => __('admin.field.buttonColor'),
    'required'   => true,
    'default'    => 'primary',
    'options'    => collect(config('cms.colors'))->map(function($key) {
        return [
            'value' => $key,
            'label' => ucfirst($key),
        ];
    })->toArray(),
])

@formField('input', [
    'name'       => 'button_text',
    'label'      => __('admin.field.buttonText'),
    'type'       => 'text',
    'required'   => true,
    'translated' => true,
    'maxlength'  => 100,
])

@formField('input', [
    'name'       => 'button_url',
    'label'      => __('admin.field.buttonUrl'),
    'type'       => 'text',
    'required'   => true,
    'translated' => true,
    'maxlength'  => 100,
])

@formField('medias', [
    'name'         => 'image',
    'label'        => __('admin.field.image'),
    'max'          => 1,
    'required'     => true,
    'withVideoUrl' => false,
    'withAddInfo'  => false,
    'withCaption'  => false,
])

@formField('select', [
    'name'       => 'position',
    'label'      => __('admin.field.imagePosition'),
    'default'    => 'left',
    'unpack'     => true,
    'options'    => [
        [
            'value' => 'left',
            'label' => __('admin.position.left'),
        ],
        [
            'value' => 'right',
            'label' => __('admin.position.right'),
        ],
    ],
])
