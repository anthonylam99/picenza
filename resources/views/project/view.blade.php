@extends('main')

@section('title', 'Dự án')
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
                                <a href="">Danh sách dự án</a> »
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
                <div class="col-md-12 col-sm-12 col-12 article-detail main-content">
                   <div class="row">
                       @foreach($posts as $post)
                           <div class="gd_news__items col-sm-12 col-12 col-md-3">
                               <div class="gd_news__item" style="float: none; border: 1px solid #cccccc; border-radius: 10px">
                                   <div class="gd_news__inner" style="float: none; padding: 10px">
                                       <figure class="gd_news__image" style="height: 188.92px; width: 100%; float: none">
                                           <a href="{{config('app.url').'/bai-viet/'.$post->seo_url}}"
                                              title="">
                                               <img
                                                   src="{{(!empty($post->avatar) ? $post->avatar : asset('/images/no-image.jpg'))}}"
                                                   alt=""
                                                   class="img-fluid">
                                           </a>
                                       </figure>
                                       <div class="gd_news__content" style="padding-top: 20px">
                                           <a href="{{'/du-an/'.$post->seo_url}}"
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
                                              href="{{'/du-an/'.$post->seo_url}}">
                                               Xem thêm </a>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       @endforeach
                   </div>
                </div>
            </div>

        </div>
    </div>
@endsection
