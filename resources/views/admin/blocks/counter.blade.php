@formField('input', [
    'name'       => 'title',
    'label'      => __('admin.field.title'),
    'translated' => true,
])

@formField('select', [
    'name'       => 'background',
    'label'      => __('admin.field.background'),
    'required'   => true,
    'default'    => 'none',
    'options'    => collect(config('cms.colorGroups'))->map(function($key) {
        return [
            'value' => $key,
            'label' => ucfirst($key),
        ];
    })->toArray(),
])

@formField('select', [
    'name'       => 'columns',
    'label'      => __('admin.field.columns'),
    'required'   => true,
    'default'    => 3,
    'options'    => collect(range(1, 3))->map(function($key) {
        return [
            'value' => $key,
            'label' => $key,
        ];
    })->toArray(),
])

@formField('repeater', [
    'type' => 'counterItem'
])
