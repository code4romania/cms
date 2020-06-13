@php
    $sectionIndex ??= null;
    $fieldIndex ??= null;

    switch ($field->input('width')) {
        case 'half':
            $class = '';
            break;

        case 'full':
        default:
            $class = 'md:col-span-2';
            break;
    }

    $attributes = collect();

    if ($field->input('required')) {
        $attributes->push('required');
    }
@endphp

<label class="block {{ $class }}">
    <span class="inline font-semibold text-black">{{ $field->translatedInput('label') }}</span>

    @if ($field->translatedInput('help') !== '')
        <span class="inline text-gray-700">{{ $field->translatedInput('help') }}</span>
    @endif

    @includeIf("front.form.{$type}", [
        'name'       => sprintf('fields[%s][%s]', $sectionIndex, $fieldIndex),
        'field'      => $field,
        'attributes' => $attributes,
    ])

    @include('front.form._error', [
        'name' => sprintf('fields.%s.%s', $sectionIndex, $fieldIndex),
    ])
</label>



