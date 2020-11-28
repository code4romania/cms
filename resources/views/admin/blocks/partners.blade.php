@twillBlockTitle('Partners list')
@twillBlockIcon('fix-grid')
@twillBlockGroup('content')

@formField('input', [
    'name'       => 'title',
    'label'      => __('admin.field.title'),
    'translated' => true,
])

@formField('select', [
    'name'       => 'columns',
    'label'      => __('admin.field.columns'),
    'default'    => 4,
    'unpack'     => true,
    'options'    => collect(range(2, 6))->map(function($i) {
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
