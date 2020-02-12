@php
    $medias = $block->imageObjects('image', 'desktop');
    $columns = $block->input('columns') ?? 1;
@endphp

<div class="container grid col-gap-8 row-gap-8 grid-cols-{{ $columns }}">
    @foreach ($medias as $media)
        @include('site.blocks._image', [
            'src' => $block->image('image', 'desktop', [], false, false, $media),
            'alt' => $block->imageAltText('image', $media),
            'caption' => $block->imageCaption('image', $media),
        ])
    @endforeach
</div>
