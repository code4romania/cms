@php
    switch ((int) $block->input('columns')) {
        case 1:
        default:
            $cols = 'md:grid-cols-1';
            break;

        case 2:
            $cols = 'md:grid-cols-2';
            break;

        case 3:
            $cols = 'md:grid-cols-3';
            break;

        case 4:
            $cols = 'md:grid-cols-4';
            break;
    }
@endphp

<section class="container">
    @if ($block->translatedInput('title'))
        <h1 class="mb-5 h2">{{ $block->translatedInput('title') }}</h1>
    @endif

    <div class="grid col-gap-8 row-gap-8 {{ $cols }}">
        @foreach ($block->imageObjects('image') as $media)
        <x-figure
            :src="$block->image('image', 'default', [], false, false, $media)"
            :alt="$block->imageAltText('image', $media)"
            :caption="$block->imageCaption('image', $media)"
        />
        @endforeach
    </div>
</section>
