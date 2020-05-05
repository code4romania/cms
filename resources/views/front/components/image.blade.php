@php
    $alt = $alt ?? '';
    $class = $class ?? 'block w-full';
    $lqip = $lqip ?? false;
@endphp

<img
    class="{{ $class }}"
    alt="{{ $alt }}"

    @if ($lqip)
        src="{{ $lqip }}"
        data-src={{ $src }}
        lazyload
    @else
        src="{{ $src }}"
    @endif
>
