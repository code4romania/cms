@php
    $index = $index ?? null;
@endphp

<div class="flex flex-col align-center">
    <h4
        x-on:click="selected = (selected !== {{ $index }} ? {{ $index }} : '')"
        class="flex items-center justify-between px-5 py-3 cursor-pointer"
        :class="{
            'bg-primary-500 hover:bg-primary-700 text-primary-100' : (selected === {{ $index }}),
            'bg-gray-300 hover:bg-gray-400 text-black' : (selected !== {{ $index }}),
        }"
        >
            <span>{{ $block->translatedInput('header') }}</span>
            <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path :d="selected === {{ $index }} ? 'M12 8l6 6H6z' : 'M12 16l-6-6h12z'"/>
            </svg>
        </h4>
    <div
        x-show="selected === {{ $index }}"
        class="px-6 py-4 border rich-content"
    >{!! $block->translatedInput('description') !!}</div>
</div>
