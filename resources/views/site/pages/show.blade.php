@extends('cms::layouts.app')

@section('content')
    <article>
        {{ $item->title }}
        {!! $item->renderBlocks(false) !!}
    </article>
@stop
