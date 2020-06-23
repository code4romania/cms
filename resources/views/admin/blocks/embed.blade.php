@formField('input', [
    'name'       => 'title',
    'label'      => __('admin.field.title'),
    'translated' => true,
])

@formField('input', [
    'name'         => 'url',
    'label'        => __('admin.field.url'),
    'note'         => __('admin.fieldNote.embedUrl'),
    'placeholder'  => 'https://',
    'required'     => true,
])
