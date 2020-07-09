@extends('front.layouts.app')

@section('content')
    <x-container>
        <div class="container">
            <div class="grid gap-10 md:grid-cols-2">
                <div class="relative h-0 bg-white border border-gray-400 aspect-ratio-1/1">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <x-image
                            :src="$item->image('image')"
                            :alt="$item->imageAltText('image')"
                            class="block w-2/3"
                        />
                    </div>
                </div>
                <div class="ck-content">
                    <h1 class="title">{{ $item->name }}</h1>
                    {!! $item->description !!}
                </div>
            </div>
        </div>

        <div class="container">
            <x-hex-badge icon="community" :title="__('misc.community')" />

            <section class="grid gap-10 mt-6 leading-tight sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($item->people as $person)
                    @include('front.people.card', [
                        'person' => $person,
                    ])
                @endforeach
            </section>
        </div>

        {!! $item->renderBlocks(false) !!}
    </x-container>
@endsection
