@extends('main')

@section('title', 'Tin tức')
@section('seo')
    @if(!empty($categoryData['seo_title']))
        <meta name="title" content="{{$categoryData['seo_title']}}">
    @else
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
                        <div class="nav-box" style="margin-bottom: 10px">
                            <div class="paginations">
                                <ul class="pagination pagination-sm" style="margin-bottom: 0;  padding-left: 10px">
                                    @if ($posts->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $posts->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                        </li>
                                    @endif

                                    <?php
                                    $start = $posts->currentPage() - 2; // show 3 pagination links before current
                                    $end = $posts->currentPage() + 2; // show 3 pagination links after current
                                    if($start < 1) {
                                        $start = 1; // reset start to 1
                                        $end += 1;
                                    }
                                    if($end >= $posts->lastPage() ) $end = $posts->lastPage(); // reset end to last page
                                    ?>

                                    @if($start > 1)
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $posts->url(1) }}">{{1}}</a>
                                        </li>
                                        @if($posts->currentPage() != 4)
                                            {{-- "Three Dots" Separator --}}
                                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                                        @endif
                                    @endif
                                    @for ($i = $start; $i <= $end; $i++)
                                        <li class="page-item {{ ($posts->currentPage() == $i) ? ' active' : '' }}">
                                            <a class="page-link" href="{{ $posts->url($i) }}">{{$i}}</a>
                                        </li>
                                    @endfor
                                    @if($end < $posts->lastPage())
                                        @if($posts->currentPage() + 3 != $posts->lastPage())
                                            {{-- "Three Dots" Separator --}}
                                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                                        @endif
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $posts->url($posts->lastPage()) }}">{{$posts->lastPage()}}</a>
                                        </li>
                                    @endif

                                    {{-- Next Page Link --}}
                                    @if ($posts->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $posts->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                            <span class="page-link" aria-hidden="true">&rsaquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                </div>
                <div class="col-md-4 col-sm-12 col-12 sidebar sidebar-default">
                    <div id="gda-popular-post-12" class="widget widget_gda-popular-post">
                        <div class="gd_widget gd_widget_article">
                            <div class="gd_widget__title"><a class="gd_widget__text"
                                                             href="https://decumar.vn/bai-viet-xem-nhieu"><span
                                        class="gd_text">Bài viết liên quan</span></a></div>
                            <div class="gd_news__items gd_widget__content">
                                @foreach($newPost as $item)
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
