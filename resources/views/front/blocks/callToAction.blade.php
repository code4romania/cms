<section class="py-8" style="{{ $block->present()->callToActionStyle }}">
    <div class="container grid items-center row-gap-8 col-gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        <div class="lg:col-span-2 xl:col-span-3">
            <h1 class="mb-3 text-2xl font-bold leading-tight lg:text-3xl xl:text-4xl">{{ $block->translatedInput('title') }}</h1>
            <div class="block-content">
                {!! $block->translatedInput('description') !!}
            </div>
        </div>

        <div class="text-center">
            @include('front.components.button', [
                'label' => $block->translatedInput('button_text'),
                'href' => $block->translatedInput('button_url'),
                'color' => $block->input('button_color'),
            ])
        </div>
    </div>
</section>
