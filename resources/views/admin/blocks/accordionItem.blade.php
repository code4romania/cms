@formField('input', [
    'name'           => 'header',
    'label'          => __('admin.field.header'),
    'translated'     => true,
])

@include('admin.utils.ckeditor', [
    'name'       => 'description',
    'label'      => __('admin.field.description'),
    'translated' => true,
])
