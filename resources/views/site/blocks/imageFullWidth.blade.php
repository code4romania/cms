<figure class="container">
    @include('site.blocks._image', [
        'src' => $block->image('image', 'desktop'),
        'alt' => $block->imageAltText('image'),
    ])

    @if ($block->imageCaption('image'))
        @include('site.blocks._imageCaption', [
            'caption' => $block->imageCaption('image')
        ])
    @endif
</figure>
