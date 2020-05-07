<section class="container grid col-gap-8 row-gap-8 grid-flow-row-dense {{ $block->present()->imageTextContainerClass }}">
    <x-figure
        :lqip="$block->lowQualityImagePlaceholder('image')"
        :src="$block->image('image', 'desktop')"
        :alt="$block->imageAltText('image')"
        :caption="$block->imageCaption('image')"
        :class="$block->present()->imageTextImageClass"
    />

    <div class="{{ $block->present()->imageTextContentClass }}">
        {!! $block->translatedInput('text') !!}
    </div>
</section>

