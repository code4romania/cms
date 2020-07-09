@twillBlockTitle('People list')
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
    'options'    => collect([2, 3, 4])->map(function($i) {
        return [
            'value' => $i,
            'label' => $i,
        ];
    })->toArray(),
])

@formField('browser', [
    'routePrefix' => 'people',
    'moduleName'  => 'people',
    'name'        => 'people',
    'label'       => __('admin.people'),
    'max'         => 100,
])

@formField('select', [
    'name'       => 'showDescriptions',
    'label'      => __('admin.field.showDescriptions'),
    'default'    => false,
    'unpack'     => true,
    'options'    => [
        [
            'value' => true,
            'label' => 'Yes',
        ],
        [
            'value' => false,
            'label' => 'No',
        ],
    ],
])
