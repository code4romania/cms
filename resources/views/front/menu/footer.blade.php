<div class="flex flex-wrap lg:col-span-2 lg:justify-end">
    @foreach (Code4Romania\Cms\Models\Menu::getLocation('footer') as $item)
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
