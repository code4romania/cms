@extends('twill::layouts.settings')

@section('contentFields')
    @formField('input', [
        'name'      => 'siteTitle',
        'label'     => __('admin.field.siteTitle'),
        'textLimit' => '80'
    ])

    @formField('input', [
        'name'      => 'siteDescription',
        'label'     => __('admin.field.siteDescription'),
        'textLimit' => '80'
    ])
@stop
