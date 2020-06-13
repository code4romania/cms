<input
    type="text"
    value="{{ old($name) }}"
    name="{{ $name }}"
    class="block w-full mt-1 form-input"
    {{ $attributes->join(' ') }}
>
