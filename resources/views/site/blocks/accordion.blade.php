@php
    $view = sprintf('%s.%s', config('twill.block_editor.block_views_path'), 'accordionItem');
@endphp

<section class="section block block-accordion">
    <div class="container">
        @foreach ($block->children as $index => $item)
            {!! view($view)->with('index', $index)->with('block', $item)->render() !!}
        @endforeach
    </div>
</section>
