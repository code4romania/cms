@formField('select', [
    'name'       => 'columns',
    'label'      => 'Columns',
    'default'    => 1,
    'unpack'     => true,
    'options'    => [
        [
            'value' => 1,
            'label' => 1,
        ],
        [
            'value' => 2,
            'label' => 2,
        ],
        [
            'value' => 3,
            'label' => 3,
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
