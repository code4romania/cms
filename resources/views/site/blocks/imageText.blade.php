@php
    switch ($block->input('width')) {
        case 'quarter':
            $imageWidth = 3;
            break;

        case 'third':
            $imageWidth = 4;
            break;

        case 'half':
            $imageWidth = 6;
            break;
    }
@endphp

<section class="section block block-image block-image-text">
    <div class="container">
        <div class="columns {{ $block->input('position') == 'right' ? 'is-reversed' : '' }}">
            <figure class="column is-{{ $imageWidth }}-tablet">
                <picture class="image is-3by2">
                    @foreach (config('twill.breakpoints') as $breakpoint)
                        <source
                            media="screen and (max-width: {{ $breakpoint - 1 }}px)"
                            srcset="{{ $block->image('image', 'default', [
                                'w' => $breakpoint
                            ]) }}">
                    @endforeach
                    <img
                        src="{{ $block->image('image', 'default', [
                                'w' => config('twill.breakpoints.tablet'),
                            ]) }}"
                        alt="{{ $block->imageAltText('image')}}">
                </picture>

                @if ($block->imageCaption('image'))
                    <figcaption class="caption">
                        <div class="has-text-grey is-italic">
                            <div class="is-flex">
                                <span class="icon has-text-grey-light">
                                    <i class="mdi mdi-18px mdi-camera"></i>
                                </span>
                                <p>{{ $block->imageCaption('image') }}</p>
                            </div>
                        </div>
                    </figcaption>
                @endif
            </figure>

            <div class="column">
                <div class="content">
                    {!! $block->translatedinput('text') !!}
                </div>
            </div>
        </div>
    </div>
</section>
