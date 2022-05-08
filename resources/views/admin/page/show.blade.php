@extends('main')

@section('title', $page->name)

@section('content')
    <div class="container">
        {!!html_entity_decode($page->content)!!}
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6783726095855070"
                crossorigin="anonymous"></script>
        <!-- test 1 -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-6783726095855070"
             data-ad-slot="2954540597"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
@endsection

