@if ($errors->has($name))
    <div role="alert" class="text-sm text-danger-500 md:text-base">
        <span>{{ $errors->first($name) }}</span>
    </div>
@endif
