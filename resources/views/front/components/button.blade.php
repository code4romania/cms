@inject('url', 'Code4Romania\Cms\Helpers\UrlHelper')

@php
    $href = $href ?? false;
    $type = $type ?? 'button';
    $color = $color ?? 'primary';
    $label = $label ?? '';

    $buttonBase = 'relative inline-block w-full px-6 py-2 font-semibold leading-snug tracking-wide text-center shadow-md sm:w-auto hover:shadow-lg focus:outline-none focus:shadow-md';

    switch ($color) {
        case 'primary':
        default:
            $buttonColor = 'text-primary-100 bg-primary-500 focus:bg-primary-600';
            break;

        case 'secondary':
            $buttonColor = 'text-secondary-900 bg-secondary-500 focus:bg-secondary-600';
            break;

        case 'danger':
            $buttonColor = 'text-danger-100 bg-danger-500 focus:bg-danger-600';
            break;
    }
@endphp

@if ($href !== false)
    <a
        href="{{ $href }}"
        class="{{ $buttonBase }} {{ $buttonColor }}"

        @if ($url->isExternal($href))
            rel="noopener noreferrer"
            target="_blank"
        @endif
    >{{ $label }}</a>
@else
    <button
        type="{{ $type }}"
        class="{{ $buttonBase }} {{ $buttonColor }}"
    >{{ $label }}</button>
@endif
