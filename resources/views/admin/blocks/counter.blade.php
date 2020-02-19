@formField('input', [
    'name'       => 'title',
    'label'      => 'Title',
    'translated' => true,
])

@formField('select', [
    'name'       => 'background',
    'label'      => 'Background',
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
    'label'      => 'Columns',
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
