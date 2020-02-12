@php
    $socialNetworks = collect(config('cms.socialNetworks'))
        ->map(function($value, $key) {
            $username = app(\A17\Twill\Repositories\SettingRepository::class)
                ->byKey($key, 'social');

            if (is_null($username)) {
                $value['url'] = null;
            } else {
                $value['url'] = $value['baseUrl'] . $username;
            }

            return $value;
        })
        ->reject(fn($value): bool => is_null($value['url']));
@endphp

<footer class="bg-gray-100 border-t-2 border-blue-800">
    <div class="container grid row-gap-16 col-gap-6 py-12 md:grid-cols-12">
        <div class="font-mono text-sm text-gray-700 md:col-span-4">

            <h2>{{ __('footer.projectby') }}</h2>

            <a href="https://code4.ro/en/">
                <img src="http://votemonitor.org.s3-website.eu-central-1.amazonaws.com/images/code4romania-full-gray.svg" class="h-8 my-4" alt="Code for Romania">
            </a>

            <p>{{  __('footer.tagline') }}</p>

            <div class="flex mt-4 -mx-2">
                @foreach ($socialNetworks as $key => $network)
                    <a href="{{ $network['url'] }}" class="mx-2 text-gray-500 hover:text-blue-700" target="_blank">
                        @svg("icons/{$key}", 'block h-5 fill-current')
                    </a>
                @endforeach
            </div>

        </div>
        <ul class="md:col-span-4 md:col-end-13">
            <li class="font-bold uppercase">Links</li>
                @for ($i = 0; $i < 3; $i++)
                <li class="mt-2">
                    <a href="#" class="hover:underline">Menu item</a>
                </li>
            @endfor
        </ul>
    </div>
</footer>
