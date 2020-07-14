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
                {{ svg('logo-sm-gray', 'absolute inset-0 flex items-center justify-center w-full h-full p-10 lg:p-20') }}
            @endif
        </div>
        <div class="px-8 py-6 leading-normal">
            <div class="flex items-center text-sm text-gray-700">
                <span>{{ $item->present()->publishDate }}</span>

                @if ($item->author)
                    <span class="mx-2" aria-hidden="true">&middot;</span>
                    <span>{{ $item->author }}</span>
                @endif
            </div>

            <h1 class="mb-4 font-semibold h2">{{ $item->title }}</h1>

            <p class="my-6 leading-relaxed">{{ $item->description }}</p>

            @if ($item->categories->count())
                <div class="flex items-center text-sm text-gray-700">
                    {{ $item->categories->pluck('title')->join(', ') }}
                </div>
            @endif
        </div>
    </a>
</article>
