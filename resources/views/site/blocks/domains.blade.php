@php
    $orderedList = $block->browserIds('domains');
    $domains     = App\Models\Domain::find($orderedList)->sortBy(function ($i) use ($orderedList) {
        return array_search($i->getKey(), $orderedList);
    });
@endphp

<section class="section block block-domains">
    <div class="container">
        <div class="section is-slim is-down">
            <header class="content">
                <h1 class="title is-size-4">{{ $block->translatedinput('title') }}</h1>
                {!! $block->translatedinput('description') !!}
            </header>
            <div class="columns is-multiline is-down">
                @foreach ($domains as $domain)
                    <div class="column is-6-tablet domain {{ !$domain->published ? 'is-inactive' : '' }}">
                        <div class="media">
                            <div class="media-left">
                                @svg('corner', 'image is-48x48')
                            </div>
                            <div class="media-content">
                                @if (!$domain->published)
                                    <strong>{{ $domain->title }}</strong>
                                @else
                                    <strong>
                                        <a class="is-link is-inversed" href="{{ route('domains.show', [ 'domain' => $domain->slug ]) }}">{{ $domain->title }}</a>
                                    </strong><br>

                                    @foreach ($domain->subdomains as $subdomain)
                                        <a class="is-link is-inversed" href="{{ route('domains.show', [ 'domain' => $subdomain->slug ]) }}">{{ $subdomain->title }}</a><br>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
