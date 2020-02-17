@extends('front.layouts.app')

@section('content')
    @if ($item->show_header)
        <header class="max-w-2xl px-6 mx-auto mb-24 text-center">
            <h1 class="text-3xl font-bold leading-tight md:text-4xl lg:text-5xl">
                {{ $item->title }}
            </h1>

            @if ($item->description)
                <div class="mt-5 text-lg leading-relaxed block-content">{!! $item->description !!}</div>
            @endif
        </header>
    @endif

    @include('front.blocks._container', [
        'item' => $item
    ])
@endsection
