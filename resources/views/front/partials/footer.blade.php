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
        @include('front.menu.footer')
    </div>
</footer>
