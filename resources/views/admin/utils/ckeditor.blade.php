@php
    $translated = $translated ?? false;
    $maxlength = $maxlength ?? false;
    $options = $options ?? false;
    $placeholder = $placeholder ?? false;
    $note = $note ?? false;
    $disabled = $disabled ?? $readonly ?? false;
    $default = $default ?? false;
    $options = $options ?? $toolbarOptions ?? false;
@endphp

@pushonce('extra_css:wysiwyg')
    <link rel="stylesheet" href="{{ asset(mix('content.css', 'assets/cms')) }}">
@endpushonce

@if($translated)
    <a17-locale
        type="a17-ckeditor"
        :attributes="{
            label: '{{ $label }}',
            @include('twill::partials.form.utils._field_name', ['asAttributes' => true])
            @if ($note) note: '{{ $note }}', @endif
            @if ($options) options: {!! e(json_encode($options)) !!}, @endif
            @if ($placeholder) placeholder: '{{ $placeholder }}', @endif
            @if ($disabled) disabled: true, @endif
            @if ($default) initialValue: '{{ $default }}', hasDefaultStore: true, @endif
            inStore: 'value'
        }"
    />
@else
    <a17-ckeditor
        label="{{ $label }}"
        @include('twill::partials.form.utils._field_name')
        @if ($note) note="{{ $note }}" @endif
        @if ($options) :options='{!! json_encode($options) !!}' @endif
        @if ($placeholder) placeholder='{{ $placeholder }}' @endif
        @if ($disabled) disabled @endif
        @if ($default)
            :initial-value="'{{ $default }}'"
            :has-default-store="true"
        @endif
        in-store="value"
    />
@endif

@unless($renderForBlocks || $renderForModal)
    @push('vuexStore')
        @include('twill::partials.form.utils._translatable_input_store')
    @endpush
@endunless
