@php
    $orderedList = $block->browserIds('people');
    $people = App\Models\Person::find($orderedList)->sortBy(function ($i) use ($orderedList) {
        return array_search($i->getKey(), $orderedList);
    });;
@endphp

<section class="section block block-people">
    <div class="container">
        <div class="section is-slim is-down">
            <header class="content">
                <h1 class="title is-size-4">{{ $block->translatedinput('title') }}</h1>
                {!! $block->translatedinput('description') !!}
            </header>
            <div class="columns is-multiline is-down">
                @foreach ($people as $item)
                    @include('site.people.loop')
                @endforeach
            </div>
        </div>
    </div>
</section>
