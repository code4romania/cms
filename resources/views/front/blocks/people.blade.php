<section class="container leading-relaxed grid gap-10 {{ $block->present()->peopleColumnsClass }}">
    @foreach ($block->present()->peopleListPublished as $person)
        @include('front.people.card', [
            'person'          => $person,
            'showDescription' => $block->input('showDescriptions'),
        ])
    @endforeach
</section>
