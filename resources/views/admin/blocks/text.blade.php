@formField('select', [
    'name'       => 'columns',
    'label'      => 'Columns',
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
    'label'          => 'Text',
    'toolbarOptions' => config('twill.toolbar_options'),
    'translated'     => true,
    'editSource'     => true,
])
