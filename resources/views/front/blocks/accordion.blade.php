@php
    $view = sprintf('%s.%s', config('twill.block_editor.block_views_path'), 'accordionItem');
@endphp

<section class="container" x-data="{ selected: 0 }">
    @foreach ($block->children as $index => $item)
        {!! view($view)->with('index', $index)->with('block', $item)->render() !!}
    @endforeach
</section>
