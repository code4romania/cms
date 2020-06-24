@php
    $network ??= null;
    $link    ??= null;
@endphp

@if ($link)
    <a
        href="{{ $link }}"
        rel="noopener noreferer"
        target="_blank"
        class="absolute right-0 p-1 text-white rounded-full bg-primary-700 hover:bg-primary-500 focus:bg-primary-500 focus:outline-none focus:shadow-outline {{ $network === 'github' ? 'top-0' : 'bottom-0' }}"
    >
        @svg("icons/{$network}", 'block h-4 fill-current')
    </a>
@endif
