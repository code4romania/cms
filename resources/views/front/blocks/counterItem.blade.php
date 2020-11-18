<div class="items-center text-center md:text-left md:flex">
    <div class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden">
        {{ svg('hex', 'absolute inset-0 z-0 ' . $badgeBackground) }}
        <span class="relative text-lg font-bold text-center px-4 text-black lg:text-xl {{ $badgeText }}">{{ $block->input('number') }}</span>
    </div>

    <div class="flex-1 mt-3 text-xl font-semibold md:mt-0 md:ml-6 lg:text-2xl">{{ $block->translatedInput('label') }}</div>
</div>
