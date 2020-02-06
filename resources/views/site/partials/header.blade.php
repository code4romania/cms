<nav class="lg:shadow-none" x-data="{ open: false }" :class="{ 'shadow-lg': open }">
    <div class="container p-5 mx-auto mb-20 gap-6 grid grid-cols-4 lg:grid-cols-12">
        <div class="col-span-3 lg:col-span-2">
            <a href="{{ route('front.pages.index') }}" class="inline-block">
                @svg('resources/svg/logo', 'block h-10 w-auto')
            </a>
        </div>

        <div class="flex justify-end col-span-1 lg:hidden">
            <button class="p-4" @click="open = !open">
                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path :d="open
                        ? 'M10 8.6L2.9 1.5 1.5 2.9 8.6 10l-7.1 7.1 1.4 1.4 7.1-7.1 7.1 7.1 1.4-1.4-7.1-7.1 7.1-7.1-1.4-1.4L10 8.6z'
                        : 'M0 3h20v2H0zM0 9h20v2H0zM0 15h20v2H0z'" />
                </svg>
            </button>
        </div>

        <ul id="header-menu" class="items-center justify-end lg:flex col-span-4 lg:col-span-9 lg:col-start-4"
            :class="{ 'hidden' : !open }" @click.away="open = false">

            @for ($i = 0; $i < 5; $i++)
                <li class="px-3 py-2 text-center">
                    <a class="inline-flex px-3 py-2 text-blue-700 rounded hover:underline hover:bg-gray-200" href="/ro/cine-suntem/">Cine suntem</a>
                </li>
            @endfor
        </ul>
    </div>
</nav>
