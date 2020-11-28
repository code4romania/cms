@extends('front.layouts.app')

@section('content')
    <section class="container text-center">
        <h1 class="my-10 h2">{{ __('errors.404') }}</h1>

        <div class="my-10">
            <x-button
                :href="route('front.pages.index', [], false)"
                color="primary"
            >{{ __('errors.back') }}</x-button>
        </div>

        <div class="w-full max-w-3xl mx-auto my-10">
            {{ svg('404', 'block w-full h-full') }}
        </div>
    </section>
@endsection
