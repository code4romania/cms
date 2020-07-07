@twillRepeaterTitle('Submenu item')
@twillRepeaterTrigger('Add submenu item')
@twillRepeaterGroup('twill')

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

            @formField('select', [
                'name'       => 'newtab',
                'label'      => __('admin.field.newTab'),
                'default'    => false,
                'unpack'     => true,
                'options'    => [
                    [
                        'value' => false,
                        'label' => __('form.no'),
                    ],
                    [
                        'value' => true,
                        'label' => __('form.yes'),
                    ],
                ],
            ])
        @elseif($type !== 'blog')
            @formField('select', [
                'name'     => 'target',
                'label'    => __("admin.{$type}"),
                'native'   => true,
                'max'      => 1,
                'options'  => Cache::store('array')->rememberForever("subMenuItem.dropdown.{$type}", function () use ($type) {
                    return app("Code4Romania\Cms\Models\\" . ucfirst($type))
                        ->with("translation:id,title,{$type}_id")
                        ->get('id')
                        ->mapWithKeys(fn ($item) => [$item->id => $item->title]);
                }),
            ])
        @endif
    @endcomponent
@endforeach
