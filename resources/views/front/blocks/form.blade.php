@php
    $form = $block->present()->formPublished;

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

<form method="POST" action="{{ route('front.form.submit', $form->id) }}">
    @foreach ($sections as $sectionIndex => $block)
        @include('front.blocks.formSection', [
            'block'        => $block,
            'fields'       => $fieldsBySection->get($block->id),
            'sectionIndex' => $sectionIndex,
        ])
    @endforeach

    <div class="container">
        @csrf

        <button type="submit">Submit</button>
    </div>
</form>
