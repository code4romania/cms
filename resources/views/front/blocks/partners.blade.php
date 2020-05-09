<section class="container leading-relaxed grid gap-10 {{ $block->present()->partnersColumnsClass }}">
    @foreach ($block->present()->partnersListPublished as $partner)
        @include('front.partners.card', [
            'partner' => $partner,
        ])
    @endforeach
</section>
