@extends('main')

@section('title', 'Tin tức')
@section('seo')
    @if(!empty($categoryData['seo_title']))
        <meta name="title" content="{{$categoryData['seo_title']}}">
    @elseif(!empty($categoryData['name']))
        <meta name="title" content="{{$categoryData['name']}}">
    @endif
    @if(!empty($categoryData['seo_description']))
        <meta name="description" content="{{$categoryData['seo_description']}}">
    @endif
    @if(!empty($categoryData['seo_keyword']))
        <meta name="keywords" content="{{$categoryData['seo_keyword']}}">
    @endif
    @if(!empty($categoryData['seo_robots']))
        <meta name="robots" content="{{$categoryData['seo_robots']}}">
    @endif
@endsection

@section('content')
    <div class="gd_breadcrumb">
        <div class="container">
            <nav class="breadcrumbs">
                <p id="breadcrumbs">
                    <span>
                        <span>
                            <a href="">Trang chủ</a> »
                            <span>
                                <a href="">Tin tức</a> »
                            </span>
                            <span
                                class="breadcrumb_last"
                                aria-current="page">{{(!empty($categoryData['name'])) ? $categoryData['name'] : ''}}</span>
                        </span>
                    </span>
                </p>
            </nav>
        </div>
    </div>
    <div class="content-post">
        <div class="container">
            <div class="content-post-ctn row">
                <div class="col-md-8 col-sm-12 col-12 article-detail main-content">
                    @foreach($posts as $post)
                        <div class="gd_news__items">
                            <div class="gd_news__item">
                                <div class="gd_news__inner">
                                    <figure class="gd_news__image" style="height: 188.92px;">
                                        <a href="{{config('app.url').'/bai-viet/'.$post->seo_url}}"
                                           title="Trị mụn thâm sẹo – Bộ sản phẩm Decumar hiệu quả thực sự?">
                                            <img
                                                src="{{(!empty($post->avatar) ? $post->avatar : asset('/images/no-image.jpg'))}}"
                                                alt="Trị mụn thâm sẹo – Bộ sản phẩm Decumar hiệu quả thực sự?"
                                                class="img-fluid">
                                        </a>
                                    </figure>
                                    <div class="gd_news__content">
                                        <a href="{{config('app.url').'/bai-viet/'.$post->seo_url}}"
                                           title="{{$post->title}}"
                                           class="gd_news__title">
                                            <h2 class="gd_text">
                                                {{$post->title}} </h2>
                                        </a>
                                        <div class="gd_news__excerpt">
                                            <?php
                                                if (strlen($post->content) > 400) {
                                                    $post->content = substr(html_entity_decode($post->content), 0, 400);
                                                    $post->content = strip_tags_content($post->content);
                                                }
                                            ?>
                                            {!!html_entity_decode($post->content).'......'!!}
                                        </div>
                                        <a class="gd_readmore"
                                           href="{{config('app.url').'/bai-viet/'.$post->seo_url}}">
                                            Xem thêm </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-4 col-sm-12 col-12 sidebar sidebar-default">
                    <div id="gda-popular-post-12" class="widget widget_gda-popular-post">
                        <div class="gd_widget gd_widget_article">
                            <div class="gd_widget__title"><a class="gd_widget__text"
                                                             href=""><span
                                        class="gd_text">Bài viết liên quan</span></a></div>
                            <div class="gd_news__items gd_widget__content">
                                @foreach($newPost as $item)
                                    <article class="gd_news__item">
                                        <div class="gd_news__inner">
                                            <figure class="gd_news__image">
                                                <a href="{{'/bai-viet/'.$item->seo_url}}">
                                                    <img
                                                        src="{{!empty($item->avatar) ? $item->avatar : asset('images/no-image.jpg') }}"
                                                        alt="">
                                                </a>
                                            </figure>
                                            <div class="gd_news__content">
                                                <a class="gd_news__title" href="{{'/bai-viet/'.$item->seo_url}}">
                                                    <span class="gd_text">
                                                        {{$item->title}}
                                                    </span>
                                                </a>
                                                <span class="gd_date"> 05-08-2021 </span>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
