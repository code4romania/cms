@formField('input', [
    'name'           => 'header',
    'label'          => 'Header',
    'translated'     => true,
])

@formField('wysiwyg', [
    'name'           => 'description',
    'label'          => 'Description',
    'toolbarOptions' => config('twill.toolbar_options'),
    'translated'     => true,
    'editSource'     => true,
])
