@php
    $alt = $alt ?? false;
    $caption = $caption ?? false;
@endphp

<figure>
    <img src="{{ $src }}" alt="{{ $alt }}" class="block max-w-full">

    @if ($caption)
        <figcaption class="table px-3 py-5 mx-auto">
            <div class="table-cell pr-3 align-top">
                @svg('icons/camera-lens', 'w-6 h-6 text-gray-400')
            </div>
            <p class="table-cell italic text-gray-600 align-top">{{ $caption }}</p>
        </figcaption>
    @endif
</figure>
