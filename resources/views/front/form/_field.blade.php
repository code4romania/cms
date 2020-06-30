@php
    $sectionIndex ??= null;
    $fieldIndex   ??= null;

    $fieldName = "fields[{$sectionIndex}][{$fieldIndex}]";
    $fieldId   = "fields.{$sectionIndex}.{$fieldIndex}";

    $fieldClass = collect(['field', 'block']);

    switch ($field->input('width')) {
        case 'half':
            $fieldClass->push('col-span-1');
            break;

        case 'full':
        default:
            $fieldClass->push('md:col-span-2');
            break;
    }
@endphp

<div class="{{ $fieldClass->join(' ') }}">
    <label for="{{ $fieldId }}">
        <span class="inline font-semibold text-black">{{ $field->translatedInput('label') }}</span>

        @if ($field->translatedInput('help') !== '')
            <span class="inline text-gray-700">{{ $field->translatedInput('help') }}</span>
        @endif
    </label>

    @includeFirst(["front.form.{$type}", 'front.form.input'], [
        'type'       => $type,
        'name'       => $fieldName,
        'id'         => $fieldId,
        'field'      => $field,
        'attributes' => $field->present()->formFieldAttributes,
    ])

    @include('front.form._error', [
        'name' => $fieldId,
    ])
</div>
