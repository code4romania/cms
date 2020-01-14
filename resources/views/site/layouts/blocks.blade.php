<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="block-preview font-sans">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Titillium+Web:400,600,700&subset=latin-ext">
    <link rel="stylesheet" href="{{ asset(mix('app.css', 'assets')) }}">
</head>
<body>
    <div id="app">
        <main class="container">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset(mix('manifest.js', 'assets')) }}"></script>
    <script src="{{ asset(mix('vendor.js', 'assets')) }}"></script>
    <script src="{{ asset(mix('app.js', 'assets')) }}"></script>
</body>
</html>
