@extends('twill::layouts.form')

@section('contentFields')
    @formField('wysiwyg', [
        'name'           => 'description',
        'label'          => __('admin.field.description'),
        'type'           => config('cms.editor.type'),
        'toolbarOptions' => config('cms.editor.toolbar'),
        'editSource'     => true,
        'translated'     => true,
    ])
@endsection
