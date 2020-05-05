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

@formField('select', [
    'name'       => 'valign',
    'label'      =>  __('admin.field.verticalAlignment'),
    'default'    => 'top',
    'unpack'     => true,
    'options'    => [
        [
            'value' => 'top',
            'label' => __('admin.position.top'),
        ],
        [
            'value' => 'center',
            'label' => __('admin.position.center'),
        ],
        [
            'value' => 'bottom',
            'label' => __('admin.position.bottom'),
        ],
    ],
])

@formField('select', [
    'name'       => 'width',
    'label'      => 'Image width',
    'default'    => '1/3',
    'unpack'     => true,
    'options'    => [
        [
            'value' => '1/4',
            'label' => '25%',
        ],
        [
            'value' => '1/3',
            'label' => '33%',
        ],
        [
            'value' => '1/2',
            'label' => '50%',
        ],
    ],
])

@formField('wysiwyg', [
    'name'           => 'text',
    'label'          => 'Text',
    'type'           => config('cms.editor.type'),
    'toolbarOptions' => config('cms.editor.toolbar'),
    'translated'     => true,
    'editSource'     => true,
])
