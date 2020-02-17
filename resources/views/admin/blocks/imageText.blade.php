@formField('medias', [
    'name'         => 'image',
    'label'        => 'Image',
    'max'          => 1,
    'required'     => true,
    'withVideoUrl' => false,
    'withAddInfo'  => false,
    'withCaption'  => false,
])

@formField('select', [
    'name'       => 'position',
    'label'      => 'Image position',
    'default'    => 'left',
    'unpack'     => true,
    'options'    => [
        [
            'value' => 'left',
            'label' => 'Left',
        ],
        [
            'value' => 'right',
            'label' => 'Right',
        ],
    ],
])

@formField('select', [
    'name'       => 'valign',
    'label'      => 'Vertical alignment',
    'default'    => 'top',
    'unpack'     => true,
    'options'    => [
        [
            'value' => 'top',
            'label' => 'Top',
        ],
        [
            'value' => 'center',
            'label' => 'Center',
        ],
        [
            'value' => 'bottom',
            'label' => 'Bottom',
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
    'toolbarOptions' => config('twill.toolbar_options'),
    'translated'     => true,
    'editSource'     => true,
])
