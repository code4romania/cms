@php
    $title ??= '';
    $icon ??= '';
@endphp

<header class="flex items-center">
    <div class="relative mr-6">
        @svg('hex', 'block w-auto h-16 md:h-24 text-primary-500')
        @svg("icons/{$icon}", 'absolute inset-0 p-4 md:p-6 m-auto text-white')
    </div>
    <h1 class="flex-1 text-2xl font-bold md:text-4xl">{{ $title }}</h1>
</header>
