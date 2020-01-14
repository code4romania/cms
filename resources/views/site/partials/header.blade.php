<nav class="p-5 bg-teal-500">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
        <div class="navbar-brand">
            <a href="{{ route('front.pages.index') }}" class="navbar-item">
                @svg('resources/svg/logo', 'h-10 w-auto')
            </a>
            <button class="block lg:hidden" data-target="header-menu" aria-label="menu" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </button>
        </div>
        <div id="header-menu" class="navbar-menu">
            <ul class="navbar-end has-text-centered-touch">
                {{-- {{- range .Site.Menus.header -}} --}}
                    <li class="navbar-item">
                        <a class="button" href="{{ ".URL" }}">
                            {{ ".Name" }}
                        </a>
                    </li>
                {{-- {{- end -}} --}}

                <li class="navbar-item">
                    {{-- {{- range .Translations -}}
                        {{- if ne $.Site.Language .Language -}} --}}
                            <a class="button is-text is-uppercase has-text-primary" href="{{ ".Permalink" }}" hreflang="{{ ".Language" }}">
                                {{ ".Language" }}
                            </a>
                        {{-- {{- end -}}
                    {{- end -}} --}}
                </li>
            </ul>
        </div>
    </div>
</nav>
