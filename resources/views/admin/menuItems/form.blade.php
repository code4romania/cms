@extends('twill::layouts.form', [
    'contentFieldsetLabel' => 'Options',
])


@section('contentFields')
    @formField('select', [
        'name'       => 'menu',
        'label'      => 'Menu',
        'required'   => true,
        'default'    => 'header',
        'options'    => collect(config('cms.menu.locations'))->map(function($key) {
            return [
                'value' => $key,
                'label' => ucfirst($key),
            ];
        })->toArray(),
    ])

    @formField('select', [
        'name'       => 'type',
        'label'      => 'Type',
        'required'   => true,
        'default'    => 'external',
        'options'    => collect(config('cms.menu.itemTypes'))->map(function($key) {
            return [
                'value' => $key,
                'label' => ucfirst($key),
            ];
        })->toArray()
    ])

    @foreach (config('cms.menu.itemTypes') as $menuItemType)
        @component('twill::partials.form.utils._connected_fields', [
            'fieldName'       => 'type',
            'fieldValues'     => $menuItemType,
            'renderForBlocks' => false,
            'keepAlive'       => false,
        ])
            @if ($menuItemType === 'external')
                @formField('input', [
                    'name'       => 'target',
                    'label'      => 'URL',
                    'translated' => false,
                    'required'   => false,
                ])
            @else
                @php
                    $options = app( config('twill.namespace') . '\\Models\\' . ucfirst($menuItemType) )
                        ->all()
                        ->map(function($item) {
                            return [
                                'value' => $item->id,
                                'label' => $item->title,
                            ];
                        })
                        ->toArray();
                @endphp

                @formField('select', [
                    'name'         => 'target',
                    'label'        => 'Page',
                    'native'       => true,
                    'max'          => 1,
                    'options'      => $options,
                ])
            @endif
        @endcomponent
    @endforeach
@endsection
