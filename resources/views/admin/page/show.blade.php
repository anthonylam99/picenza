@extends('main')

@section('title', $page->name)

@section('content')
    <div class="container">
        {!!html_entity_decode($page->content)!!}
    </div>
@endsection
