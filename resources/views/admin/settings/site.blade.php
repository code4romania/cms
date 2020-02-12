@extends('twill::layouts.settings')

@php
    $allPages = app( config('twill.namespace') . '\Models\Page')
        ->all()
        ->map(function($item) {
            return [
                'value' => $item->id,
                'label' => $item->title,
            ];
        })
        ->toArray();
@endphp

@section('contentFields')
    @formField('select', [
        'name'         => 'frontPage',
        'label'        => 'Front page',
        'native'       => true,
        'max'          => 1,
        'options'      => $allPages,
    ])
@stop
