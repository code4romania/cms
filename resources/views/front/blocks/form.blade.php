@php
    $form = $block->present()->formPublished;

    if (is_null($form)) {
        return;
    }

    $sections = $form->blocks->where('type', 'formSection');

    $fieldsBySection = $form->blocks
        ->where('type', 'formField')
        ->filter(fn ($block) => $block->parent_id !== null)
        ->groupBy('parent_id');

    $data = $sections->map(function($section, $sectionIndex) use ($fieldsBySection) {
        return $fieldsBySection
            ->get($section->id)
            ->map(fn ($field, $fieldIndex) => null);
    });
@endphp

<form class="grid grid-cols-1 row-gap-10" method="POST" action="{{ route('front.form.submit', $form->id) }}">
    @foreach ($sections as $block)
        @include('front.blocks.formSection', [
            'block'        => $block,
            'fields'       => $fieldsBySection->get($block->id),
            'sectionIndex' => $loop->index,
        ])
    @endforeach

    <div class="container">
        @csrf

        <x-button type="submit">{{ __('form.submit') }}</x-button>
    </div>
</form>
