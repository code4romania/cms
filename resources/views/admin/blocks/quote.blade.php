@formField('input', [
    'name'       => 'quote',
    'type'       => 'textarea',
    'label'      => 'Quote',
    'required'   => true,
    'translated' => true,
    'rows'       => 4,
])

@formField('input', [
    'name'       => 'author',
    'type'       => 'text',
    'label'      => 'Author',
    'required'   => true,
    'translated' => true,
    'maxlength'  => 100,
])

@formField('input', [
    'name'       => 'affiliation',
    'type'       => 'text',
    'label'      => 'Affiliation',
    'translated' => true,
    'maxlength'  => 100,
])
