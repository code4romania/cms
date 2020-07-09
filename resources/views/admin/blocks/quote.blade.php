@twillBlockTitle('Quote')
@twillBlockIcon('quote')
@twillBlockGroup('content')

@include('admin.utils.ckeditor', [
    'name'       => 'quote',
    'label'      => __('admin.field.quote'),
    'translated' => true,
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
