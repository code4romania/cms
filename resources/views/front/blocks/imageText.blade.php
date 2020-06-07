@php
    $container = collect();
    $imageRight = collect('col-span-1');
    $content = collect('rich-text');

    switch ($block->input('width')) {
        case '1/4':
            $container->push('md:grid-cols-4');
            $imageRight->push('md:col-start-4');
            $content->push('md:col-span-3');
            break;

        case '1/3':
            $container->push('md:grid-cols-3');
            $imageRight->push('md:col-start-3');
            $content->push('md:col-span-2');
            break;

        case '1/2':
            $container->push('md:grid-cols-2');
            $imageRight->push('md:col-start-2');
            $content->push('md:col-span-1');
            break;
    }

    switch ($block->input('valign')) {
        case 'top':
            $container->push('items-start');
            break;

        case 'center':
            $container->push('items-center');
            break;

        case 'bottom':
            $container->push('items-end');
            break;
    }

    if ($block->input('position') === 'right') {
        $figure = $imageRight->implode(' ');
    } else {
        $figure = null;
    }
@endphp

<section class="container grid col-gap-8 row-gap-8 grid-flow-row-dense {{ $container->implode(' ') }}">
    <x-figure
        :lqip="$block->lowQualityImagePlaceholder('image')"
        :src="$block->image('image')"
        :alt="$block->imageAltText('image')"
        :caption="$block->imageCaption('image')"
        :class="$figure"
    />

    <div class="{{ $content->implode(' ') }}">
        {!! $block->translatedInput('text') !!}
    </div>
</section>

