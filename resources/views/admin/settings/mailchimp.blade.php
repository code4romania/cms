@extends('twill::layouts.settings')

@section('contentFields')
    @formField('input', [
        'name'       => 'apiKey',
        'label'      => __('admin.field.apiKey'),
        'translated' => false,
    ])
@stop
