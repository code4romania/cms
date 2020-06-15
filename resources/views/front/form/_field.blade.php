@php
    $sectionIndex ??= null;
    $fieldIndex ??= null;
    $fieldClass = collect('block');

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

<label class="{{ $fieldClass->join(' ') }}">
    <span class="inline font-semibold text-black">{{ $field->translatedInput('label') }}</span>

    @if ($field->translatedInput('help') !== '')
        <span class="inline text-gray-700">{{ $field->translatedInput('help') }}</span>
    @endif

    @includeFirst(["front.form.{$type}", 'front.form.input'], [
        'type'       => $type,
        'name'       => sprintf('fields[%s][%s]', $sectionIndex, $fieldIndex),
        'field'      => $field,
        'attributes' => $field->present()->formFieldAttributes,
    ])

    @include('front.form._error', [
        'name' => sprintf('fields.%s.%s', $sectionIndex, $fieldIndex),
    ])
</label>
