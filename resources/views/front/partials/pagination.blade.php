@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('pagination.label') }}" class="flex items-center justify-between px-4 text-base font-medium leading-tight text-gray-800 border-t border-gray-200 sm:px-0 md:col-span-2">
        <div class="flex justify-between flex-1">

            {{-- Previous Page Link --}}
            <div class="flex flex-1 w-0">
                @if (!$paginator->onFirstPage())
                    <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex items-center py-4 -mt-px transition duration-150 ease-in-out border-t-2 border-transparent hover:border-primary-500 focus:outline-none focus:border-primary-800">
                        {!! __('pagination.previous') !!}
                    </a>
                @endif
            </div>

            {{-- Pagination Elements --}}
            <div class="hidden md:flex">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true" class="inline-flex items-center p-4 -mt-px text-gray-500 border-t-2 border-transparent cursor-default">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page" class="inline-flex items-center p-4 -mt-px transition duration-150 ease-in-out border-t-2 cursor-default text-primary-600 border-primary-500 focus:outline-none focus:text-primary-800 focus:border-primary-700">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="inline-flex items-center p-4 -mt-px transition duration-150 ease-in-out border-t-2 border-transparent hover:border-gray-300 focus:outline-none focus:border-gray-400" aria-label="{{ __('pagination.goto', ['page' => $page]) }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            <div class="flex justify-end flex-1 w-0">
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex items-center py-4 -mt-px transition duration-150 ease-in-out border-t-2 border-transparent hover:border-primary-500 focus:outline-none focus:border-primary-800">
                        {!! __('pagination.next') !!}
                    </a>
                @endif
            </div>
        </div>
    </nav>
@endif
