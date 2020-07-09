<article class="flex {{ $class ?? '' }}">
    <a href="{{ route('front.posts.show', ['slug' => $item->slug]) }}" class="block w-full overflow-hidden transition-shadow duration-150 rounded-sm shadow-lg hover:shadow-xl">
        <div class="relative border-b aspect-ratio-2/1">
            @if ($item->hasImage('image'))
                <x-figure
                    :lqip="$item->lowQualityImagePlaceholder('image')"
                    :src="$item->image('image')"
                    :alt="$item->imageAltText('image')"
                    class="absolute inset-0 flex items-center justify-center w-full"
                />
            @else
                @svg('logo-sm-gray', 'absolute inset-0 flex items-center justify-center w-full h-full p-10 lg:p-20')
            @endif
        </div>
        <div class="px-8 py-6 leading-normal">
            <h1 class="mb-4 font-semibold h2">{{ $item->title }}</h1>
            <div class="flex items-center mb-6 text-base text-gray-800">
                <span>{{ $item->present()->publishDate }}</span>

                @if ($item->author)
                    <span class="mx-2" aria-hidden="true">&middot;</span>
                    <span>{{ $item->author }}</span>
                @endif

                @if ($item->categories->count())
                    <span class="mx-2" aria-hidden="true">&middot;</span>
                    <span>{{ $item->categories->pluck('title')->join(', ') }}</span>
                @endif
            </div>

            <p class="leading-relaxed">{{ $item->description }}</p>
        </div>
    </a>
</article>
