@php
    $title ??= '';
    $description ??= '';
@endphp

<header class="max-w-2xl px-6 mx-auto mb-24 text-center">
    <h1 class="h1">
        {{ $title }}
    </h1>

    @if ($description)
        <div class="mt-5 text-lg leading-relaxed ck-content">{!! $description !!}</div>
    @endif
</header>
