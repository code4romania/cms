@extends('cms::layouts.app')

@section('content')
    <article>
        <div class="section is-slim">
            {!! $item->renderBlocks(false) !!}
        </div>
    </article>
@stop
