@formField('input', [
    'name' => $titleFormKey ?? 'title',
    'label' => ucfirst($titleFormKey ?? 'title'),
    'translated' => $translateTitle ?? false,
    'required' => true,
])

@formField('select', [
    'name'       => 'menu',
    'label'      => 'Menu',
    'required'   => true,
    'default'    => 'header',
    'options'    => collect(config('cms.menu.locations'))->map(function($key) {
        return [
            'value' => $key,
            'label' => ucfirst($key),
        ];
    })->toArray(),
])
