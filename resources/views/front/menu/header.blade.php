@inject('url', 'Code4Romania\Cms\Helpers\UrlHelper')

@php
    $alternateUrls = $url->getAlternateLocaleUrls(Route::currentRouteName(), $item ?? null);
    $baseButton = 'px-3 py-2 rounded hover:bg-gray-100 focus:bg-gray-200 focus:outline-none';
@endphp

<ul id="header-menu" class="relative z-50 items-center justify-end w-full col-span-4 lg:w-auto lg:flex lg:col-span-9 lg:col-start-4"
    :class="{ 'hidden' : !open }" x-on:click.away="open = false" x-cloak>

    @foreach (Code4Romania\Cms\Models\Menu::getLocation('header') as $item)
        @continue(empty($item['label']))

        <li class="relative py-2 lg:ml-6">
            @if ($item['children'])
                <div x-data="{ open: false }" x-on:click.away="open = false">
                    <button class="{{ $baseButton }} hidden font-light lg:flex lg:items-center" x-on:click="open = !open">
                        <span>{{ $item['label'] }}</span>
                        {{ svg('icons/dropdown', '-mr-1 ml-1 h-5 w-5') }}
                    </button>

                    <x-link
                        class="{{ $baseButton }} flex lg:hidden"
                        href="{{ $item['url'] }}"
                        newtab="{{ $item['newtab'] }}"
                    >{{ $item['label'] }}</x-link>

                    <div class="pl-5 lg:shadow-xs lg:pl-0 lg:absolute lg:right-0 lg:mt-2 lg:w-48 lg:origin-top-right lg:bg-white" :class="{ 'lg:hidden' : !open }" x-cloak>
                        <ul class="lg:shadow-lg">
                            @if (!is_null($item['url']))
                                <li>
                                    <x-link
                                        class="{{ $baseButton }} hidden font-bold lg:flex lg:rounded-none"
                                        href="{{ $item['url'] }}"
                                        newtab="{{ $item['newtab'] }}"
                                    >{{ $item['label'] }}</x-link>
                                </li>
                            @endif

                            @foreach ($item['children'] as $child)
                                @continue(empty($child['label']) || is_null($child['url']))
                                <li>
                                    <x-link
                                        class="{{ $baseButton }} flex"
                                        href="{{ $child['url'] }}"
                                        newtab="{{ $child['newtab'] }}"
                                    >{{ $child['label'] }}</x-link>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @elseif ($item['style'] === 'button')
                <x-button
                    :href="$item['url']"
                    :color="$item['color']"
                >{{ $item['label'] }}</x-button>
            @else
                <x-link
                    class="{{ $baseButton }} flex"
                    href="{{ $item['url'] }}"
                    newtab="{{ $item['newtab'] }}"
                >{{ $item['label'] }}</x-link>
            @endif
        </li>
    @endforeach


    @if ($alternateUrls)
        <li class="relative py-2 lg:ml-6">
            @if (count($alternateUrls) === 1)
                @foreach ($alternateUrls as $locale => $url)
                    <a
                        class="inline-flex p-2 rounded hover:bg-gray-100 focus:bg-gray-200 focus:outline-none"
                        title="{{ config("translatable.languages.$locale") }}"
                        hreflang="{{ $locale }}"
                        href="{{ $url }}"
                    >{{ strtoupper($locale) }}</a>
                @endforeach
            @else
                <div x-data="{ open: false }" x-on:click.away="open = false">
                    <button class="{{ $baseButton }} hidden font-light lg:flex lg:items-center" x-on:click="open = !open">
                        {{ svg('icons/global', 'w-5 h-5 text-gray-900') }}
                        {{ svg('icons/dropdown', '-mr-1 ml-1 h-5 w-5') }}
                    </button>

                    <div class="flex lg:hidden">
                        {{ svg('icons/global', 'w-5 h-5 text-gray-900') }}
                    </div>

                    <div class="pl-5 lg:shadow-xs lg:pl-0 lg:absolute lg:right-0 lg:mt-2 lg:w-48 lg:origin-top-right lg:bg-white" :class="{ 'lg:hidden' : !open }" x-cloak>
                        <ul class="lg:shadow-lg">
                            @foreach ($alternateUrls as $locale => $url)
                                <li>
                                    <a
                                        class="{{ $baseButton }} flex"
                                        hreflang="{{ $locale }}"
                                        href="{{ $url }}"
                                    >{{ config("translatable.languages.$locale") }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </li>
    @endif
</ul>
