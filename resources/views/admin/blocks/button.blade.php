@twillBlockTitle('Button')
@twillBlockIcon('colors')
@twillBlockGroup('content')

@formField('select', [
    'name'       => 'button_color',
    'label'      => __('admin.field.buttonColor'),
    'required'   => true,
    'default'    => 'primary',
    'options'    => collect(config('cms.colors'))->map(function($key) {
        return [
            'value' => $key,
            'label' => ucfirst($key),
        ];
    })->toArray(),
])

@formField('input', [
    'name'       => 'button_text',
    'label'      => __('admin.field.buttonText'),
    'type'       => 'text',
    'required'   => true,
    'translated' => true,
    'maxlength'  => 100,
])

@formField('input', [
    'name'       => 'button_url',
    'label'      => __('admin.field.buttonUrl'),
    'type'       => 'text',
    'required'   => true,
    'translated' => true,
    'maxlength'  => 100,
])
