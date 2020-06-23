<section class="container">
    @if ($block->translatedInput('title'))
        <h1 class="mb-5 h2">{{ $block->translatedInput('title') }}</h1>
    @endif

    <div class="">
        {!! $block->present()->embedCode !!}
    </div>
</section>
