@extends('twill::layouts.form')

@section('contentFields')
    @formField('input', [
        'name'        => 'website',
        'label'       => __('admin.field.website'),
        'type'        => 'text',
    ])

    @formField('medias', [
        'name'         => 'logo',
        'label'        => __('admin.field.logo'),
        'withVideoUrl' => false,
        'withAddInfo'  => false,
        'withCaption'  => false,
    ])
@endsection
