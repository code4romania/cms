@extends('twill::layouts.settings')

@section('contentFields')
    @formField('input', [
        'name' => 'siteTitle',
        'label' => 'Site title',
        'textLimit' => '80'
    ])

    @formField('input', [
        'name' => 'siteDescription',
        'label' => 'Site description',
        'textLimit' => '80'
    ])
@stop
