@twillBlockTitle('Accordion')
@twillBlockIcon('media-list')
@twillBlockGroup('content')

@formField('input', [
    'name'       => 'title',
    'label'      => __('admin.field.title'),
    'translated' => true,
])

@formField('repeater', [
    'type' => 'accordionItem'
])
