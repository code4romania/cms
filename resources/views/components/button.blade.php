@inject('url', 'Code4Romania\Cms\Helpers\UrlHelper')

@php
    $href ??= false;
    $type ??= 'button';
    $color ??= 'primary';

    $buttonBase = 'relative inline-block w-full px-6 py-2 font-semibold leading-snug tracking-wide text-center shadow-md sm:w-auto hover:shadow-lg focus:outline-none focus:shadow-md';

    switch ($color) {
        case 'primary':
            $buttonColor = 'text-white bg-primary-500 focus:bg-primary-600';
            break;

        case 'secondary':
            $buttonColor = 'text-black bg-secondary-500 focus:bg-secondary-600';
            break;

        case 'danger':
            $buttonColor = 'text-white bg-danger-500 focus:bg-danger-600';
            break;

        case 'success':
            $buttonColor = 'text-white bg-success-500 focus:bg-success-600';
            break;

        case 'black':
            $buttonColor = 'text-white bg-black focus:bg-gray-900';
            break;

        case 'gray':
            $buttonColor = 'text-white bg-gray-500 focus:bg-gray-600';
            break;

        default:
            $buttonColor = 'border focus:bg-gray-100';
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
    >{{ $slot }}</a>
@else
    <button
        type="{{ $type }}"
        class="{{ $buttonBase }} {{ $buttonColor }}"
    >{{ $slot }}</button>
@endif
