@formField('input', [
    'name'       => 'title',
    'label'      => __('admin.field.title'),
    'type'       => 'text',
    'required'   => true,
    'translated' => true,
    'maxlength'  => 100,
])

@formField('wysiwyg', [
    'name'           => 'description',
    'label'          => __('admin.field.description'),
    'toolbarOptions' => config('twill.toolbar_options'),
    'editSource'     => true,
    'translated'     => true,
])

@formField('select', [
    'name'       => 'button_color',
    'label'      => __('admin.field.buttonColor'),
    'required'   => true,
    'default'    => 'primary',
    'options'    => collect(config('cms.colorGroups'))->map(function($key) {
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
