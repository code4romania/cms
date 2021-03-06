@inject('settings', 'Code4Romania\Cms\Helpers\settingsHelper')

@extends('front.layouts.app')

@section('content')
    @include('front.partials.page-header', [
        'title'       => $settings->get('blogTitle', 'site'),
        'description' => $settings->get('blogDescription', 'site'),
    ])

    <x-container class="container md:grid-cols-2 md:col-gap-16">
        @foreach ($items as $item)
            @include('front.posts.card', [
                'item'  => $item,
            ])
        @endforeach

        {{ $items->links('front.partials.pagination') }}
    </x-container>
@endsection
