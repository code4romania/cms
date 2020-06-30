<select id="{{ $id }}" name="{{ $name }}" {!! $attributes !!} class="block w-full mt-1 {{ $field->input('multiple') ? 'form-multiselect': 'form-select' }}">
    @foreach ($field->present()->formFieldOptions as $option)
        <option {{ $option === old($id) ? 'selected' : '' }}>{{ $option }}</option>
    @endforeach
</select>
