@formField('input', [
    'name'       => 'title',
    'type'       => 'text',
    'label'      => 'Title',
    'required'   => true,
    'translated' => true,
    'maxlength'  => 100,
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
