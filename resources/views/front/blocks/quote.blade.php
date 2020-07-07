<section class="container leading-relaxed ck-content">
    <blockquote>
        {!! $block->translatedInput('quote') !!}
    </blockquote>

    @if ($block->translatedInput('author'))
        <cite>
            <strong>{{ $block->translatedInput('author') }}</strong>

            @if ($block->translatedInput('affiliation'))
                <br><em>{{ $block->translatedInput('affiliation') }}</em>
            @endif
        </cite>
    @endif
</section>
