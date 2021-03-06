<section class="py-8">
    <div class="container grid items-center row-gap-8 col-gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        <div class="lg:col-span-2 xl:col-span-3">
            <h1 class="mb-5 h2">{{ $block->translatedInput('title') }}</h1>
            <div class="ck-content">
                {!! $block->translatedInput('description') !!}
            </div>
        </div>

        <div class="text-center">
            <x-button
                :href="$block->translatedInput('button_url')"
                :color="$block->input('button_color')"
            >{{ $block->translatedInput('button_text') }}</x-button>
        </div>
    </div>
</section>
