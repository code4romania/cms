@formField('input', [
    'name'           => 'header',
    'label'          => __('admin.field.header'),
    'translated'     => true,
])

@formField('wysiwyg', [
    'name'           => 'description',
    'label'          =>__('admin.field.description'),
    'type'           => config('cms.editor.type'),
    'toolbarOptions' => config('cms.editor.toolbar'),
    'translated'     => true,
    'editSource'     => true,
])
