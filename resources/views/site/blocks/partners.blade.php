@php
    $orderedList = $block->browserIds('partners');
    $partners = App\Models\Partner::find($orderedList)->sortBy(function ($i) use ($orderedList) {
        return array_search($i->getKey(), $orderedList);
    });

    switch ($block->input('width')) {
        case 'quarter':
            $logoWidth = 3;
            break;

        case 'third':
            $logoWidth = 4;
            break;

        case 'half':
            $logoWidth = 6;
            break;
    }
@endphp

<section class="section block block-partners">
    <div class="container">
        <div class="section is-slim is-down">
            @if ($block->translatedinput('title'))
                <header class="content">
                    <h1 class="title is-size-4">{{ $block->translatedinput('title') }}</h1>
                    {!! $block->translatedinput('description') !!}
                </header>
            @endif
            <div class="columns is-multiline is-down">
                @foreach ($partners as $item)
                    @include('site.partners.loop', [
                        'showTitle' => $block->input('displayNames'),
                    ])
                @endforeach
            </div>
        </div>
    </div>
</section>
