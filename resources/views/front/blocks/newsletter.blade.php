<section class="container grid items-center row-gap-8 col-gap-8 md:grid-cols-2 lg:grid-cols-3">
    <div class="ck-content lg:col-span-2">
        {!! $block->translatedInput('text') !!}
    </div>

    <form class="grid grid-cols-1 col-span-1 row-gap-6" method="POST" action="{{ route('front.newsletter.subscribe') }}">
        @csrf

        <input type="hidden" name="list" value="{{ $block->input('list') }}">

        <label class="block">
            <span class="inline font-semibold text-black">{{ __('form.field.email') }}</span>

            @include('front.form.input', [
                'id'         => 'email',
                'type'       => 'email',
                'name'       => 'email',
                'attributes' => 'required',
            ])

            @include('front.form._error', [
                'name' => 'email',
            ])
        </label>

        <x-button type="submit">{{ __('form.subscribe') }}</x-button>

        @if (session('success'))
            <div role="alert" class="text-sm text-success-500 md:text-base">
                <span class="">{{ session('success') }}</span>
            </div>
        @endif
    </form>
</section>
