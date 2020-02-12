
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
    'name'       => 'width',
    'label'      => 'Image width',
    'default'    => 'third',
    'unpack'     => true,
    'options'    => [
        [
            'value' => 'quarter',
            'label' => '25%',
        ],
        [
            'value' => 'third',
            'label' => '33%',
        ],
        [
            'value' => 'half',
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
