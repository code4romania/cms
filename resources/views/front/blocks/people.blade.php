<section class="container leading-relaxed rich-content grid gap-10 {{ $block->present()->peopleColumnsClass }}">
    @foreach ($block->present()->peopleListPublished as $person)
        <article>
            <div class="flex items-center">
                <div class="relative mr-4">
                    @include('front.components.image', [
                        'lqip'  => $person->present()->imageLqip(),
                        'src'   => $person->present()->imageSrc(),
                        'alt'   => $person->imageAltText('image'),
                        'class' => 'w-24 h-24 overflow-hidden rounded-full'
                    ])

                    @foreach (['github', 'linkedin'] as $network)
                        @continue(!$person->$network)

                        @include('front.components.socialNetworkLink', [
                            'network' => $network,
                            'link'    => $person->$network,
                        ])
                    @endforeach
                </div>

                <div>
                    <h1 class="text-xl font-bold">{{ $person->name }}</h1>
                    <span class="text-base">{{ $person->title }}</span>
                </div>

            </div>

            @if ($block->input('showDescriptions') && $person->description)
                <div class="mt-4 rich-text">
                    {!! $person->description !!}
                </div>
            @endif
        </article>
    @endforeach
</section>
