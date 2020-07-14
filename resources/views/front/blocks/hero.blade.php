<section class="container flex flex-col-reverse items-center leading-relaxed md:flex-row jusitfy-between">
    <div class="md:w-1/2">
        <div class="text-3xl font-bold leading-none tracking-wide lg:text-5xl">
            <h1 class="mb-2">{{ $block->translatedInput('title') }}</h1>
            <h2 class="mb-6">{{ $block->translatedInput('subtitle') }}</h2>
        </div>

        <div class="my-10 leading-relaxed ck-content lg:text-xl">
            {!! $block->translatedInput('content') !!}
        </div>

        <x-button
            :href="$block->translatedInput('button_url')"
            :color="$block->input('button_color')"
        >{{ $block->translatedInput('button_text') }}</x-button>

    </div>
    @if ($block->hasImage('image'))
        <div class="mt-8 mb-16 md:mb-0 md:mt-0 md:w-1/2 md:pl-12">
            <x-figure
                :lqip="$block->lowQualityImagePlaceholder('image')"
                :src="$block->image('image')"
                :alt="$block->imageAltText('image')"
                :caption="$block->imageCaption('image')"
                :class="$block->present()->imageTextImageClass"
            />
        </div>
    @endif
</section>
