@inject('menu', 'Code4Romania\Cms\Helpers\MenuHelper')
@inject('social', 'Code4Romania\Cms\Helpers\SocialHelper')

<footer class="bg-gray-100 border-t-4 border-primary-500">
    <div class="container grid row-gap-10 col-gap-6 py-12 lg:grid-cols-3">
        <div class="font-mono text-sm text-gray-700">
            <h2>{{ __('footer.projectby') }}</h2>

            <a href="https://code4.ro/en/">
                @svg('logo-gray', 'h-8 my-4')
            </a>

            <p>{{ __('footer.tagline') }}</p>

            <div class="flex mt-4 -mx-2">
                @foreach ($social->getNetworks() as $network => $url)
                    <a
                        href="{{ $url }}"
                        class="mx-2 text-gray-500 hover:text-primary-500 focus:text-primary-500 focus:outline-none"
                        target="_blank"
                    >@svg("icons/{$network}", 'block h-5 fill-current')</a>
                @endforeach
            </div>
        </div>
        <div class="flex flex-wrap lg:col-span-2 lg:justify-end">
            @foreach ($menu->getItemsTree('footer') as $item)
                <ul class="w-full py-5 md:w-1/2 md:px-3 lg:py-0 lg:w-1/4">
                    <li class="font-bold uppercase">
                        @if (!empty($item['url']))
                            <a
                                class="hover:text-primary-500 focus:text-primary-500 focus:outline-none hover:underline focus:underline"
                                href="{{ $item['url'] }}"
                            >{{ $item['label'] }}</a>
                        @else
                            {{ $item['label'] }}
                        @endif
                    </li>

                    @foreach ($item['children'] as $children)
                        <li class="mt-2">
                            <a
                                class="hover:text-primary-500 focus:text-primary-500 focus:outline-none hover:underline focus:underline"
                                href="{{ $children['url'] }}"
                            >{{ $children['label'] }}</a>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
</footer>
