@twillBlockTitle('Notice')
@twillBlockIcon('info')
@twillBlockGroup('content')

@formField('select', [
    'name'       => 'color',
    'label'      => __('admin.field.background'),
    'required'   => true,
    'default'    => 'none',
    'options'    => collect(config('cms.colors'))
        ->map(function($key) {
            return [
                'value' => $key,
                'label' => ucfirst($key),
            ];
        })->toArray(),
])

@include('admin.utils.ckeditor', [
    'name'       => 'content',
    'label'      => __('admin.field.content'),
    'translated' => true,
])
