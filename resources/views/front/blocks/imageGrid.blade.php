<section class="container grid col-gap-8 row-gap-8 md:grid-cols-{{ $block->input('columns') ?? 1 }}">
    @foreach ($block->imageObjects('image', 'desktop') as $media)
       <x-figure
            :src="$block->image('image', 'desktop', [], false, false, $media)"
            :alt="$block->imageAltText('image', $media)"
            :caption="$block->imageCaption('image', $media)"
        />
    @endforeach
</section>
