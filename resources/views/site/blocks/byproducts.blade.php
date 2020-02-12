@php
    $orderedList = $block->browserIds('byproducts');
    $byproducts = App\Models\Byproduct::find($orderedList)->sortBy(function ($i) use ($orderedList) {
        return array_search($i->getKey(), $orderedList);
    });;
    $profilePage = $profilePage ?? false;
@endphp

<section class="section block block-byproducts">
    <div class="container">
        <div class="columns">
            @foreach ($byproducts as $item)
                @include('site.byproducts.loop')
            @endforeach
        </div>
    </div>
</section>
