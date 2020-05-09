@formField('select', [
    'name'       => 'columns',
    'label'      => __('admin.field.columns'),
    'default'    => 4,
    'unpack'     => true,
    'options'    => collect([2, 3, 4])->map(function($i) {
        return [
            'value' => $i,
            'label' => $i,
        ];
    })->toArray(),
])

@formField('browser', [
    'moduleName'  => 'partners',
    'name'        => 'partners',
    'label'       => __('admin.partners'),
    'max'         => 100,
])
