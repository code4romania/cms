@if ($errors->has($name))
    <div class="text-danger-500" role="alert">
        <span class="">{{ $errors->first($name) }}</span>
    </div>
@endif
