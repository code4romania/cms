<a
    class="{{ $class }}"
    href="{{ $href }}"
    @if ($newtab)
        target="_blank"
        rel="noopener noreferrer"
    @endif
>{{ $slot }}</a>
