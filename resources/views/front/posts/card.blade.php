<article class="w-full {{ $class }}">
    <a href="{{ route('front.posts.show', ['slug' => $item->slug]) }}" class="block overflow-hidden transition-shadow duration-150 rounded-sm shadow-lg hover:shadow-xl">
        <x-figure
            :lqip="$item->lowQualityImagePlaceholder('image')"
            :src="$item->image('image')"
            :alt="$item->imageAltText('image')"
            class="w-full border-b"
        />
        <div class="px-8 py-6 leading-normal">
            <h1 class="mb-4 font-semibold h2">{{ $item->title }}</h1>
            <div class="flex items-center mb-6 text-base text-gray-800">
                <span>{{ $item->created_at->isoFormat(__('date.format')) }}</span>

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
