@php
    $showDescription ??= false;
@endphp

<article>
    <div class="flex items-center">
        <div class="relative flex-shrink-0 mr-4">
            <x-image
                class="w-24 h-24 overflow-hidden rounded-full"
                :lqip="$person->present()->imageLqip()"
                :src="$person->present()->imageSrc()"
                :alt="$person->imageAltText('image')"
            />

            @foreach (['github', 'linkedin'] as $network)
                @continue(!$person->$network)

                <x-social-network-link :network="$network" :link="$person->$network" />
            @endforeach
        </div>

        <div>
            <h1 class="text-xl font-bold">{{ $person->name }}</h1>
            <span class="text-base">{{ $person->title }}</span>
        </div>

    </div>

    @if ($showDescription && $person->description)
        <div class="mt-4 rich-text">
            {!! $person->description !!}
        </div>
    @endif
</article>
