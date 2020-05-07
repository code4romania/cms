@extends('front.layouts.app')

@section('content')

    @foreach ($items as $item)

        {{ $item->name }}
    @endforeach
@endsection
