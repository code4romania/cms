<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="font-light block-preview">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset(mix('app.css', 'assets/cms')) }}">
</head>
<body>
    <main class="md:text-lg">
        @yield('content')
    </main>

    @include('site.partials.scripts')
</body>
</html>
