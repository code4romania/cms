<section class="section block block-quote">
    <div class="container">
        <blockquote>
            <p>{{ $block->translatedinput('quote') }}</p>
        </blockquote>

        @if ($block->translatedinput('author'))
            <cite>
                <strong>&ndash; {{ $block->translatedinput('author') }}</strong>

                @if ($block->translatedinput('affiliation'))
                    <br><em>{{ $block->translatedinput('affiliation') }}</em>
                @endif
            </cite>
        @endif
    </div>
</section>
