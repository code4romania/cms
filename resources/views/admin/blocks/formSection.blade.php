@formField('input', [
    'name'           => 'name',
    'label'          => __('admin.field.name'),
    'type'           => 'text',
    'required'       => true,
    'translated'     => true,
])

@include('admin.utils.ckeditor', [
    'name'       => 'description',
    'label'      => __('admin.field.description'),
    'translated' => true,
])

@formField('repeater', [
    'type' => 'formField',
])
