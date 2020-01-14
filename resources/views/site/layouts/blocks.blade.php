<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="font-sans block-preview">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Titillium+Web:400,600,700&subset=latin-ext">
    <link rel="stylesheet" href="{{ asset(mix('app.css', 'assets/cms')) }}">
</head>
<body>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>

    @include('cms::partials.scripts')
</body>
</html>
