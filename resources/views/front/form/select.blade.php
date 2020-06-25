<select name="{{ $name }}" {!! $attributes !!} class="block w-full mt-1 {{ $field->input('multiple') ? 'form-multiselect': 'form-select' }}">
    @foreach ($field->present()->formFieldSelectOptions as $option)
        <option>{{ $option }}</option>
    @endforeach
</select>
