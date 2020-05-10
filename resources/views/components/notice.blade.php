@php
    $classes = collect();

    switch ($color) {
        case 'primary':
            $classes->push('bg-primary-700');
            $classes->push('text-white');
            break;

        case 'warning':
            $classes->push('bg-warning-400');
            $classes->push('text-black');
            break;

        case 'danger':
            $classes->push('bg-danger-700');
            $classes->push('text-white');
            break;

        case 'gray':
            $classes->push('bg-gray-800');
            $classes->push('text-white');
            break;
    }
@endphp

<div class="{{ $classes->implode(' ') }}">
    <div class="max-w-5xl p-3 mx-auto text-center sm:px-6 lg:px-8 rich-text">
        {!! $content !!}
    </div>
</div>
