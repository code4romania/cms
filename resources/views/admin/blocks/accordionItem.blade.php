@formField('input', [
    'name'           => 'header',
    'label'          => __('admin.field.header'),
    'translated'     => true,
])

@formField('wysiwyg', [
    'name'           => 'description',
    'label'          =>__('admin.field.description'),
    'toolbarOptions' => config('twill.toolbar_options'),
    'translated'     => true,
    'editSource'     => true,
])
