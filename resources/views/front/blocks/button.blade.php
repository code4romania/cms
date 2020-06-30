<section class="container py-8 text-center">
    <x-button
        :href="$block->translatedInput('button_url')"
        :color="$block->input('button_color')"
    >{{ $block->translatedInput('button_text') }}</x-button>
</section>
