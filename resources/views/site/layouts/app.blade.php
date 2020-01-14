<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="font-sans">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- {!! SEO::generate() !!} --}}

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Titillium+Web:400,600,700&subset=latin-ext">
    <link rel="stylesheet" href="{{ asset(mix('app.css', 'assets/cms')) }}">

    {{-- Favicons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
</head>
<body>
    <div id="app">
        @include('cms::partials.header')

        <main>
            @yield('content')
        </main>

        @include('cms::partials.footer')
    </div>

    @include('cms::partials.scripts')

    @include('cms::partials.analytics')
</body>
</html>
