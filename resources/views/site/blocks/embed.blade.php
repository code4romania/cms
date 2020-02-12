@php
    $url = $block->input('url');

    if (!$url) {
        return;
    }

    if (null === ($embed = getEmbedForUrl($url))) {
        return;
    }

@endphp

<section class="section block block-embed">
    <div class="container">
        <div class="content">
            @include('site.partials.embed', [
                'embed' => $embed,
            ])
        </div>
    </div>
</section>
