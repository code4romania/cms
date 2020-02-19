@inject('url', 'Code4Romania\Cms\Helpers\UrlHelper')

@php
    $view = sprintf('%s.%s', config('twill.block_editor.block_views_path'), 'accordionItem');
    $isBlockPreview = $url->isBlockPreview();
@endphp

<section class="container" x-data="{ selected: 0 }">
    @foreach ($block->children as $index => $child)
        @include($view, [
            'index'     => $index,
            'block'     => $child,
            'isPreview' => $isBlockPreview,
        ])
    @endforeach
</section>
