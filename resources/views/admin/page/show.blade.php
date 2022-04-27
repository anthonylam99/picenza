@extends('main')

@section('title', $page->name)

@section('content')
    <div class="container">
        <?php echo("$page->content"); ?>
    </div>
@endsection
