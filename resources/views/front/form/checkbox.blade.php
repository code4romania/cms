<div class="block w-full mt-1">
    @foreach ($field->present()->formFieldOptions as $option)
        <label class="inline-flex items-center pr-4">
            <input type="checkbox" id="{{ $id }}.{{ $loop->index }}" name="{{ $name }}[{{ $loop->index }}]" value="{{ $option }}" class="form-checkbox" {{ $option === old($id . '.' . $loop->index) ? 'checked' : '' }} {!! $attributes !!}>
            <span class="ml-2">{{ $option }}</span>
        </label>
    @endforeach
</div>
