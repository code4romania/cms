@php
    $view = sprintf('%s.%s', config('twill.block_editor.block_views_path'), 'counterItem');
@endphp

<section class="">
    <div class="container">
        <h1>{{ $block->translatedInput('title') }}</h1>

        <div class="grid grid-cols-3 gap-8">
            @foreach ($block->children as $index => $item)
                {!! view($view)->with('index', $index)->with('block', $item)->render() !!}
            @endforeach
        </div>
    </div>
</section>
