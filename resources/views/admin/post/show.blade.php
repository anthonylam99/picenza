@extends('main')

@section('title', $post->title)
@section('seo')
    @if(!empty($post->seo_title))
        <meta name="title" content="{{$post->seo_title}}">
    @else
        <meta name="title" content="{{$post->name}}">
    @endif
    @if(!empty($post->seo_description))
        <meta name="description" content="{{$post->seo_description}}">
    @endif
    @if(!empty($post->seo_keyword))
        <meta name="keywords" content="{{$post->seo_keyword}}">
    @endif
    @if(!empty($post->seo_robots))
        <meta name="robots" content="{{$post->seo_robots}}">
    @endif
    @if(!empty($detailProduct->avatar_path))
        <meta name="image" content="{{$item->avatar}}">
        <meta property="og:image" content="{{$item->avatar}}">
    @endif
@endsection

@section('content')
    <div class="gd_breadcrumb">
        <div class="container">
            <nav class="breadcrumbs">
                <p id="breadcrumbs"><span><span><a href="">Trang chủ</a> » <span><a
                                    href="">Bài viết</a> » <span
                                    class="breadcrumb_last" aria-current="page">{{$post->title}}</span></span></span></span>
                </p></nav>
        </div>
    </div>
    <div class="content-post">
        <div class="container">
            <div class="content-post-ctn row">
                <div class="col-md-8 col-sm-12 col-12 article-detail main-content">
                    <article class="gd_news__single">
                        <h1 class="gd_news__single_title">
                            {{$post->title}}
                        </h1>
                        <div class="gd_news__meta">

                            <span class="doctor">Danh mục: <br>{{$post->category_name}}<br></span>
                            <span class="date">
                                    Ngày đăng: <br>{{date('d/m/Y', strtotime($post->created_at))}}
                            </span>
                            <span class="date">
			                    Lần cập nhật cuối: <br>{{date('d/m/Y', strtotime($post->updated_at))}}
                            </span>
                            <span class="author">
                                Tag: <br> {{$post->tag}}
                            </span>
                            <span class="views">
                            </span>
                        </div>
                        <div class="gd_news__single_content">
                            <?php echo("$post->content"); ?>
                        </div>
                    </article>

                </div>
                <div class="col-md-4 col-sm-12 col-12 sidebar sidebar-default">
                    <div id="gda-popular-post-12" class="widget widget_gda-popular-post">
                        <div class="gd_widget gd_widget_article">
                            <div class="gd_widget__title"><a class="gd_widget__text"
                                                             href="https://decumar.vn/bai-viet-xem-nhieu"><span
                                        class="gd_text">Bài viết liên quan</span></a></div>
                            <div class="gd_news__items gd_widget__content">
                                @foreach($relatePost as $item)
                                    <article class="gd_news__item">
                                        <div class="gd_news__inner">
                                            <figure class="gd_news__image">
                                                <a href="{{$item->url}}">
                                                    <img
                                                        src="{{!empty($item->avatar) ? $item->avatar : asset('images/no-image.jpg') }}"
                                                        alt="">
                                                </a>
                                            </figure>
                                            <div class="gd_news__content">
                                                <a class="gd_news__title" href="{{$item->url}}">
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
