<section class="container leading-relaxed rich-content">
    @foreach ($block->present()->cityLabsListPublished as $cityLab)
        <x-image
            :lqip="$cityLab->lowQualityImagePlaceholder('image')"
            :src="$cityLab->image('image')"
            :alt="$cityLab->imageAltText('image')"
            class="block w-full"
        />

        <div class="">
            {{ $cityLab->name }}
        </div>
    @endforeach
</section>
