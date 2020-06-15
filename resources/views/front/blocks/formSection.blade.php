@php
    $fields ??= $block->children;
    $sectionIndex ??= null;
@endphp

<fieldset class="container">
    <legend class="block mb-8">
        <h2 class="font-bold">{{ $block->translatedInput('name') }}</h2>
        <div class="rich-text">{!! $block->translatedInput('description') !!}</div>
    </legend>

    <div class="grid gap-6 md:grid-cols-2">
        @foreach ($fields as $field)
            @include('front.form._field', [
                'type'       => $field->input('type'),
                'field'      => $field,
                'fieldIndex' => $loop->index,
            ])
        @endforeach
    </div>
</fieldset>
