<div class="block w-full mt-1">
    @foreach ($field->present()->formFieldOptions as $option)
        <label class="inline-flex items-center pr-4">
            <input type="radio" id="{{ $id }}.{{ $loop->index }}" name="{{ $name }}" value="{{ $option }}" class="form-radio" {{ $option === old($id) ? 'checked' : '' }} {!! $attributes !!}>
            <span class="ml-2">{{ $option }}</span>
        </label>
    @endforeach
</div>
