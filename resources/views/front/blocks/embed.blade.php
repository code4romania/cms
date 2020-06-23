@php
    $ratio = $block->present()->embedAspectRatio;
@endphp

<section class="container">
    @if ($block->translatedInput('title'))
        <h1 class="mb-5 h2">{{ $block->translatedInput('title') }}</h1>
    @endif

    <div class="{{ $ratio ? "embed aspect-ratio-{$ratio}" : '' }}">
        {!! $block->present()->embedCode !!}
    </div>
</section>
