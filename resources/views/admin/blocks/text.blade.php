@twillBlockTitle('Text')
@twillBlockIcon('text')
@twillBlockGroup('content')

@include('admin.utils.ckeditor', [
    'name'       => 'text',
    'label'      => __('admin.field.text'),
    'translated' => true,
])
