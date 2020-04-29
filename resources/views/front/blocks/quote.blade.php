<section class="container leading-relaxed rich-content">
    <blockquote>
        <p>{{ $block->translatedinput('quote') }}</p>
    </blockquote>

    @if ($block->translatedinput('author'))
        <cite>
            <strong>{{ $block->translatedinput('author') }}</strong>

            @if ($block->translatedinput('affiliation'))
                <br><em>{{ $block->translatedinput('affiliation') }}</em>
            @endif
        </cite>
    @endif
</section>
