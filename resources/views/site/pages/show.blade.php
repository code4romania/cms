@extends('layouts.app')

@section('content')
    <header class="max-w-2xl px-6 mx-auto mb-24 text-center">
        <h1 class="text-3xl font-bold leading-tight md:text-4xl lg:text-5xl">
            {{ $item->title }}
        </h1>

        @if ($item->description)
            <div class="mt-5 text-lg leading-relaxed">{!! $item->description !!}</div>
        @endif
    </header>

    @include('site.blocks._container', [
        'item' => $item
    ])
@endsection

