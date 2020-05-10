@formField('wysiwyg', [
    'name'           => 'text',
    'label'          => __('admin.field.text'),
    'type'           => config('cms.editor.type'),
    'toolbarOptions' => config('cms.editor.toolbar'),
    'translated'     => true,
    'editSource'     => true,
])
