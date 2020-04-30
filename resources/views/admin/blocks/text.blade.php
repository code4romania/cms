@formField('select', [
    'name'       => 'columns',
    'label'      => __('admin.field.columns'),
    'default'    => 1,
    'unpack'     => true,
    'options'    => collect([1, 2, 3])->map(function($i) {
        return [
            'value' => $i,
            'label' => $i,
        ];
    })->toArray(),
])

@formField('wysiwyg', [
    'name'           => 'text',
    'label'          => __('admin.field.text'),
    'toolbarOptions' => config('twill.toolbar_options'),
    'translated'     => true,
    'editSource'     => true,
])
