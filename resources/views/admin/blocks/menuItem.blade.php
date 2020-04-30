@formField('input', [
    'name'           => 'label',
    'label'          => __('admin.field.label'),
    'translated'     => true,
])

@formField('select', [
    'name'       => 'type',
    'label'      => __('admin.field.type'),
    'required'   => true,
    'default'    => false,
    'options'    => collect(config('cms.menu.itemTypes'))
        ->map(fn($type) => [ 'value' => $type, 'label' => __("admin.menu.type.{$type}") ])
        ->toArray()
])

@foreach (config('cms.menu.itemTypes') as $type)
    @component('twill::partials.form.utils._connected_fields', [
        'fieldName'       => 'type',
        'fieldValues'     => $type,
        'renderForBlocks' => true,
        'keepAlive'       => false,
    ])
        @if ($type === 'external')
            @formField('input', [
                'type'       => 'text',
                'name'       => 'target',
                'label'      => __('admin.field.url'),
                'translated' => false,
                'required'   => false,
            ])
        @else
            @formField('select', [
                'name'     => 'target',
                'label'    => __("admin.model.{$type}"),
                'native'   => true,
                'max'      => 1,
                'options'  => app( config('twill.namespace') . '\\Models\\' . ucfirst($type) )
                    ->publishedInListings()
                    ->get()
                    ->map(fn($item) => [ 'value' => $item->id, 'label' => $item->title ])
                    ->toArray(),
            ])
        @endif
    @endcomponent
@endforeach


@formField('repeater', [
    'type' => 'menuItem',
])
