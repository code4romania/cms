@extends('twill::layouts.form')

@section('contentFields')
    @formField('select', [
        'name'       => 'location',
        'label'      => __('admin.field.menuLocation'),
        'required'   => true,
        'default'    => false,
        'options'    => collect(config('cms.menu.locations'))->map(function($key) {
            return [
                'value' => $key,
                'label' => ucfirst($key),
            ];
        })->toArray(),
    ])
@endsection

@section('fieldsets')
    <a17-fieldset title="{{ __('admin.field.menuItems') }}" id="content-blocks">
        @formField('block_editor', [
            'withoutSeparator' => true,
            'group' => 'form',
        ])
    </a17-fieldset>
@endsection
