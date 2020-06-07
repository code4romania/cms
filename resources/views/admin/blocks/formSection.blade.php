@formField('input', [
    'name'           => 'name',
    'label'          => __('admin.field.name'),
    'type'           => 'text',
    'required'       => true,
    'translated'     => true,
])

@formField('wysiwyg', [
    'name'           => 'description',
    'label'          => __('admin.field.description'),
    'type'           => config('cms.editor.type'),
    'toolbarOptions' => config('cms.editor.toolbar'),
    'translated'     => true,
    'editSource'     => true,
])

@formField('repeater', [
    'type' => 'formField',
])
