@php
    $fields ??= $block->children;
    $sectionIndex ??= null;
@endphp

<section class="container">
    <header class="mb-8">
        <h1 class="font-bold">{{ $block->translatedInput('name') }}</h1>
        <div class="rich-text">
            {!! $block->translatedInput('description') !!}
        </div>
    </header>

    <div class="grid gap-6 md:grid-cols-2">
        @foreach ($fields as $fieldIndex => $field)
            @include('front.form._field', [
                'type'       => $field->input('type'),
                'field'      => $field,
                'fieldIndex' => $fieldIndex,
            ])
        @endforeach
    </div>
</section>
