@php
    $view = sprintf('%s.%s', config('twill.block_editor.block_views_path'), 'formField');
    $fields = $block->children->map('getFormFieldParams');
@endphp

<c-application-form-section
    title="{{ $block->translatedinput('name') }}"
    description="{{ $block->translatedinput('description') }}"
    :fields="{{ json_encode($fields) }}"
></c-application-form-section>
