@php
    $view = sprintf('%s.%s', config('twill.block_editor.block_views_path'), 'counterItem');
@endphp

<section class="py-10 {{ $block->present()->counterContainerClass }}">
    <div class="container">
        <h1 class="mb-8 text-center h2">{{ $block->translatedInput('title') }}</h1>

        <div class="grid gap-8 {{ $block->present()->counterColumnsClass }}">
            @foreach ($block->children as $index => $item)
                {!!
                    view($view)
                        ->with([
                            'index' => $index,
                            'block' => $item,
                            'badgeBackground' => $block->present()->counterBadgeBackgroundClass,
                            'badgeText' => $block->present()->counterBadgeTextClass,
                        ])
                        ->render()
                !!}
            @endforeach
        </div>
    </div>
</section>
