@php
    $type = $type ?? 'text';
    $required = $required ?? false;
    $label = $label ?? null;
    $placeholder = $placeholder ?? null;
@endphp

<div class="block my-4">
    @if ($label)
        <label class="flex text-gray-700" for="form-input_{{ $name }}">{{ $label }}</label>
    @endif
    <input
        id="form-input_{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        class="form-input"
        @if ($required) required @endif
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
    >
</div>
