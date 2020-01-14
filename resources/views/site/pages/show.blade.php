@extends('cms::layouts.app')

@section('content')
    <article>
        {!! $item->renderBlocks(false) !!}
    </article>
@stop
