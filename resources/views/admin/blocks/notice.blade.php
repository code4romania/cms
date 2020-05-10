@formField('select', [
    'name'       => 'color',
    'label'      => __('admin.field.background'),
    'required'   => true,
    'default'    => 'none',
    'options'    => collect(config('cms.colors'))
        ->map(function($key) {
            return [
                'value' => $key,
                'label' => ucfirst($key),
            ];
        })->toArray(),
])

@formField('wysiwyg', [
    'name'           => 'content',
    'label'          => __('admin.field.text'),
    'type'           => config('cms.editor.type'),
    'toolbarOptions' => config('cms.editor.toolbar'),
    'translated'     => true,
    'editSource'     => true,
    'maxlength'      => 200,
])
