@extends('main')

@section('title', $post->title)

@section('content')
    <div class="container">
        <?php echo("$post->title"); ?>
        <?php echo("$post->content"); ?>
    </div>
@endsection
