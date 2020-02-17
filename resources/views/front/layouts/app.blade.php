<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="font-light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SEO::generate() !!}

    <link rel="stylesheet" href="{{ asset(mix('app.css', 'assets/cms')) }}">

    {{-- Favicons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
</head>
<body class="flex flex-col min-h-screen">
    @include('front.partials.header')

    <main class="flex-1 py-20 md:text-lg">
        @yield('content')
    </main>

    @include('front.partials.footer')
    @include('front.partials.scripts')
    @include('front.partials.analytics')
</body>
</html>
