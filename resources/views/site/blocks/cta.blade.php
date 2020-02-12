@php

@endphp

<div class="section block block-subscribe"
    style="
        @if ($block->input('background_color')) background-color: {{ $block->input('background_color') }}; @endif
        @if ($block->input('text_color')) color: {{ $block->input('text_color') }}; @endif
    ">
    <div class="container">
        <div class="section is-slim">
            <div class="columns is-multiline is-vcentered">
                <div class="column is-12-tablet is-7-desktop is-8-widescreen">
                    <h1 class="is-size-3 has-text-weight-semibold">{{ $block->translatedinput('title') }}</h1>
                    <div class="content">
                        {!! $block->translatedinput('description') !!}
                    </div>
                </div>

                <div class="column is-12-tablet is-5-desktop is-4-widescreen">
                    <a
                        target="_blank" rel="noopener noreferrer"
                        href="{{ $block->translatedinput('button_url') }}"
                        class="button is-success is-medium is-fullwidth">
                        {{ $block->translatedinput('button_text') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
