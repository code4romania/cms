@formField('input', [
    'name'       => 'quote',
    'label'      => __('admin.field.quote'),
    'type'       => 'textarea',
    'required'   => true,
    'translated' => true,
    'rows'       => 4,
])

@formField('input', [
    'name'       => 'author',
    'label'      => __('admin.field.author'),
    'type'       => 'text',
    'required'   => true,
    'translated' => true,
    'maxlength'  => 100,
])

@formField('input', [
    'name'       => 'affiliation',
    'label'      => __('admin.field.affiliation'),
    'type'       => 'text',
    'translated' => true,
    'maxlength'  => 100,
])
