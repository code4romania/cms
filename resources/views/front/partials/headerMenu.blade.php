@inject('menu', 'Code4Romania\Cms\Helpers\MenuHelper')
@inject('url', 'Code4Romania\Cms\Helpers\UrlHelper')

@php
    $alternateUrls = $url->getAlternateLocaleUrls(Route::currentRouteName(), $item ?? null);
    $baseButton = 'px-3 py-2 rounded hover:bg-gray-100 focus:bg-gray-200 focus:outline-none';
@endphp

<ul id="header-menu" class="items-center justify-end w-full col-span-4 lg:w-auto lg:flex lg:col-span-9 lg:col-start-4"
    :class="{ 'hidden' : !open }" x-on:click.away="open = false">

    @foreach ($menu->getItemsTree('header') as $item)
        @continue(empty($item['label']))

        <li class="relative py-2 lg:ml-6">
            @if ($item['children'])
                <div x-data="{ open: false }" x-on:click.away="open = false">
                    <button class="{{ $baseButton }} hidden lg:flex lg:items-center"  x-on:click="open = !open">
                        <span>{{ $item['label'] }}</span>
                        @svg('icons/dropdown', '-mr-1 ml-1 h-5 w-5')
                    </button>
                    <a
                        class="{{ $baseButton }} flex lg:hidden"
                        href="{{ $item['url'] }}"
                    >{{ $item['label'] }}</a>

                    <div class="pl-5 lg:shadow-xs lg:pl-0 lg:absolute lg:right-0 lg:mt-2 lg:w-48 lg:origin-top-right lg:bg-white" :class="{ 'lg:hidden' : !open }">
                        <ul class="lg:shadow-lg">
                            @if (!is_null($item['url']))
                                <li>
                                    <a
                                        class="{{ $baseButton }} hidden font-bold lg:flex lg:rounded-none"
                                        href="{{ $item['url'] }}"
                                    >{{ $item['label'] }}</a>
                                </li>
                            @endif
                            @foreach ($item['children'] as $child)
                                @continue(empty($child['label']) || is_null($child['url']))
                                <li>
                                    <a
                                        class="{{ $baseButton }} flex"
                                        href="{{ $child['url'] }}"
                                    >{{ $child['label'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @else
                <a
                    class="{{ $baseButton }}"
                    href="{{ $item['url'] }}"
                >{{ $item['label'] }}</a>
            @endif
        </li>
    @endforeach

    @foreach ($alternateUrls as $locale => $url)
        <li class="py-2 lg:ml-6">
            <a
                class="{{ $baseButton }} flex"
                title="{{ config("translatable.languages.$locale") }}"
                hreflang="{{ $locale }}"
                href="{{ $url }}"
            >{{ strtoupper($locale) }}</a>
        </li>
    @endforeach
</ul>