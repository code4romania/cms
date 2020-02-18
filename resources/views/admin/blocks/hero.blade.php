@formField('input', [
    'name'           => 'title',
    'label'          => 'Title',
    'translated'     => true,
])

@formField('input', [
    'name'           => 'subtitle',
    'label'          => 'Subtitle',
    'translated'     => true,
])

@formField('wysiwyg', [
    'name'           => 'content',
    'label'          => 'Content',
    'toolbarOptions' => config('twill.toolbar_options'),
    'translated'     => true,
    'editSource'     => true,
])
@formField('wysiwyg', [
    'name'           => 'description',
    'label'          => 'Description',
    'toolbarOptions' => config('twill.toolbar_options'),
    'editSource'     => true,
    'translated'     => true,
])

@formField('select', [
    'name'       => 'button_color',
    'label'      => 'Button color',
    'required'   => true,
    'default'    => 'primary',
    'options'    => collect(config('cms.colorGroups'))->map(function($key) {
        return [
            'value' => $key,
            'label' => ucfirst($key),
        ];
    })->toArray(),
])

@formField('input', [
    'name'       => 'button_text',
    'type'       => 'text',
    'label'      => 'Button text',
    'required'   => true,
    'translated' => true,
    'maxlength'  => 100,
])

@formField('input', [
    'name'       => 'button_url',
    'type'       => 'text',
    'label'      => 'Button link',
    'required'   => true,
    'translated' => true,
    'maxlength'  => 100,
])

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
