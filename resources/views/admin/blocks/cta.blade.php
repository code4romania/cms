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

@formField('color', [
    'name'           => 'background_color',
    'label'          => 'Background color',
])

@formField('color', [
    'name'           => 'text_color',
    'label'          => 'Text color',
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
