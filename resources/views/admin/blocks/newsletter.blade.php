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

