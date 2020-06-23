@inject('url', 'Code4Romania\Cms\Helpers\UrlHelper')

<section class="container">
    @if ($block->translatedInput('title'))
        <h1 class="mb-5 h2">{{ $block->translatedInput('title') }}</h1>
    @endif

    @foreach ($block->children as $child)
        @include('front.blocks.accordionItem', [
            'index'     => $loop->index,
            'block'     => $child,
            'isPreview' => $url->isAdminUrl(),
        ])
    @endforeach
</section>
