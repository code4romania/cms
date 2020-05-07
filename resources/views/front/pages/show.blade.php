@extends('front.layouts.app')

@section('content')
    @includeWhen($item->show_header === true, 'front.partials.page-header', [
        'title'       => $item->title,
        'description' => $item->description,
    ])

    @include('front.blocks._container', [
        'item' => $item
    ])
@endsection
