@php
    $outerClass = 'relative h-0 bg-white border border-gray-400 aspect-ratio-1/1';
@endphp

<article>
    @if ($partner->website)
        <a
            class="{{ $outerClass }} block hover:border-gray-800 focus:outline-none focus:shadow-outline"
            href="{{ $partner->website }}"
            title="{{ $partner->name }}"
            rel="noopener noreferrer"
            target="_blank"
        >
    @else
        <div class="{{ $outerClass }}">
    @endif

    <div class="absolute inset-0 flex items-center justify-center">
        <x-image
            class="w-4/5"
            :src="$partner->present()->imageSrc"
            :alt="$partner->imageAltText('logo')"
        />
    </div>

    @if ($partner->website)
        </a>
    @else
        </div>
    @endif

</article>
