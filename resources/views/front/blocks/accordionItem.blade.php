@php
    $isPreview = $isPreview ?? false;
@endphp

<div class="flex flex-col align-center" x-data="{ open: {{ var_export($index === 0 ?: $isPreview ?: false) }} }">
    <h4
        @if (!$isPreview)
            x-on:click="open = !open"
        @endif
        class="flex items-center justify-between px-5 py-3 cursor-pointer"
        :class="{
            'bg-primary-500 hover:bg-primary-700 text-primary-100' : open,
            'bg-gray-300 hover:bg-gray-400 text-black' : !open,
        }"
    >
        <span>{{ $block->translatedInput('header') }}</span>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
            <path :d="open ? 'M12 8l6 6H6z' : 'M12 16l-6-6h12z'"/>
        </svg>
    </h4>
    <div
        x-show="{{ !$isPreview ? 'open' : 'true' }}"
        class="px-6 py-4 border ck-content"
    >{!! $block->translatedInput('description') !!}</div>
</div>
