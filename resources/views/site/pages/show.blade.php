@extends('cms::layouts.app')

@section('content')
    <header class="text-center col-span-6 col-start-4">
        <h1 class="mb-6 text-3xl font-bold leading-tight md:text-4xl lg:text-5xl">
            {{ $item->title }}
        </h1>
        <div class="text-lg leading-relaxed">{!! $item->description !!}</div>
    </header>
    {!! $item->renderBlocks(false) !!}
@endsection

