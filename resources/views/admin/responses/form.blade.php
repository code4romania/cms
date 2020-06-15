@extends('twill::layouts.free')

@section('customPageContent')
    <a17-fieldset title="{{ __('form.database') }}">
        @formField('input', [
            'readonly' => true,
            'name'     => 'created_at',
            'label'    => __('form.created_at'),
            'default'  => $item->created_at,
        ])

        @formField('input', [
            'readonly' => true,
            'name'     => 'form',
            'label'    => __('admin.form'),
            'default'  => $item->presentAdmin()->form,
        ])
    </a17-fieldset>

    @foreach ($item->data as $sectionIndex => $section)
        <a17-fieldset title="{{ $section['title'] }}">
            @foreach ($section['fields'] as $fieldIndex =>$field)
                @formField('input', [
                    'readonly' => true,
                    'name'     => "field[{$sectionIndex}][{$fieldIndex}]",
                    'label'    => $field['label'],
                    'default'  => $field['value'],
                ])
            @endforeach
        </a17-fieldset>
    @endforeach
@endsection
