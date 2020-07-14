@php
    $alt ??= false;
    $caption ??= false;
    $class ??= '';
    $lqip ??= false;
@endphp

<figure @if ($class) class="{{ $class }}" @endif>
    <x-image :lqip="$lqip" :src="$src" :alt="$alt" class="block w-full" />

    @if ($caption)
        <figcaption class="table py-3 mx-auto">
            <div class="table-cell pr-3 align-top">
                {{ svg('icons/camera-lens', 'w-6 h-6 text-gray-400') }}
            </div>
            <p class="table-cell italic text-gray-600 break-all align-top">{{ $caption }}</p>
        </figcaption>
    @endif
</figure>
