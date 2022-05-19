@extends('main')

@section('title', 'Trang chủ')

@section('scripts')
    <script src="{{asset('js/owl.carousel.js')}}"></script>
@endsection


@section('content')
    <div class="home">
        <div class="banner w-100">
            <div class="owl-carousel banner owl-theme">
                @foreach($banner as $value)
                    <img src="{{$value->image_path}}" alt="">
                @endforeach
            </div>
        </div>
        @if(isset($subPage['intro']))
            <?php
                $intro = $subPage['intro'];
                $post = \App\Models\Post::where('id', $intro['post'])->first();
            ?>
            <div class="intro">
                <div class="intro-content container">
                    <div class="intro-content__content row">
                        <div class="intro-content__left col-xs-3 col-lg-3 col-sm-3 col-12">
                            <h4 class="intro-title col-sm-10 col-12">
                                {{$intro['title']}}
                            </h4>
                            <div class="intro-post">
                                <button>
                                    <a href="/bai-viet/{{$post->seo_url}}">
                                        TÌM HIỂU THÊM
                                    </a>
                                </button>
                            </div>
                        </div>
                        <div class="intro-content__right col-xs-9 col-lg-9 col-sm-9 col-12">
                            <div class="content">
                                <p>
                                    <?php echo nl2br($intro['content']); ?>
                                </p>
                            </div>
                            <div class="number-running text-center">
                                <div class="number-running__content row">
                                    <div class="item col-xs-4 col-lg-4 col-sm-4 col-4">
                                        <div class="number number-count">
                                            {{$intro['des'][0]['number']}}
                                        </div>
                                        <div class="title-number">
                                            <h6>{{$intro['des'][0]['text']}}</h6>
                                        </div>
                                    </div>
                                    <div class="item col-xs-4 col-lg-4 col-sm-4 col-4">
                                        <div class="number d-flex justify-content-center">
                                            <div class="number-count">
                                                {{$intro['des'][1]['number']}}
                                            </div>
                                            <div class="plus">
                                                +
                                            </div>
                                        </div>
                                        <div class="title-number">
                                            <h6>{{$intro['des'][1]['text']}}</h6>
                                        </div>
                                    </div>
                                    <div class="item col-xs-4 col-lg-4 col-sm-4 col-4">
                                        <div class="number d-flex justify-content-center">
                                            <div class="number-count">
                                                {{$intro['des'][2]['number']}}
                                            </div>
                                            <div class="plus">
                                                +
                                            </div>
                                        </div>
                                        <div class="title-number">
                                            <h6>{{$intro['des'][2]['text']}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if(isset($subPage['diff']))
            <?php
            $diff = $subPage['diff'];
            ?>
            <div class="different">
                <div class="different-content container">
                    <div class="title">
                        <h5>
                            {{$diff['title']}}
                        </h5>
                    </div>
                    <div class="content row">
                        @foreach($diff['des'] as $des)
                            <div class="item col-xs-4 col-lg-4 col-sm-4 col-12">
                                <div class="item-content">
                                    <div class="image">
                                        <img src="{{asset($des['image'])}}" alt="">
                                    </div>
                                    <div class="sub-content">
                                        <div class="title-sub">
                                            <h5>{{$des['title']}}</h5>
                                        </div>
                                        <div class="line"></div>
                                        <div class="content">
                                            <p>
                                                {{$des['content']}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <div class="product-category">
            <div class="product-category-content container">
                <div class="title text-center">
                    <h5>DANH MỤC SẢN PHẨM</h5>
                </div>
                <div class="content  text-center">
                    <div class="owl-carousel category owl-theme">
                        @foreach($category as $value)
                            <div class="product-category-item text-center">
                                <div class="div-center">
                                    <a href="/san-pham/{{$value->seo_url}}">
                                        <div class="product-category-item-content">
                                            <img src="{{$value->avatar}}" alt="">
                                        </div>
                                        <h5>{{$value->name}}</h5>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="options-3 container">
            <div class="options-3-content">
                <div class="owl-carousel options3 owl-theme">
                    @if(isset($arrPostPage['section3']))
                        @foreach($arrPostPage['section3'] as $section3)
                            <div class="options-3-item">
                                <div class="image">
                                    <a href="{{$section3->url}}">
                                        <img src="{{!empty($section3->image_path) ? $section3->image_path : asset('/images/no-image.jpg')}}" alt="">
                                        <div class="text-title">
                                            <h5>{{$section3->title}}</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="options-3 container" style="padding: 30px 15px;">
            <div class="option-3-title">
                <h4>DỰ ÁN TIÊU BIỂU</h4>
            </div>
            <div class="options-3-content">
                <div class="owl-carousel options4 projects owl-theme">
                    @if(isset($project))
                        @foreach($project as $item)
                            <div class="options-3-item">
                                <div class="image">
                                    <a href="/du-an/{{$item->seo_url}}">
                                        <img src="{{!empty($item->avatar) ? asset($item->avatar) : asset('/images/no-image.jpg')}}" alt="">
                                        <div class="text-title">
                                            <h5>{{$item->title}}</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="section-4">
            <div class="section-4-content container">
                <div class="title">
                    <h5>KHÁM PHÁ CÁC KHẢ NĂNG</h5>
                </div>
                <div class="content">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @if(isset($arrPostPage['section4']))
                                @for($i = 0; $i< count($arrPostPage['section4']); $i++)
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$i}}"
                                    class="{{$i === 0 ? 'active' : ''}}" aria-current="true" aria-label="Slide {{$i}}"></button>
                                @endfor
                            @endif
                        </div>
                        <div class="carousel-inner">
                            @if(isset($arrPostPage['section4']))
                                @for($i = 0; $i< count($arrPostPage['section4']); $i++)
                                    <div class="carousel-item {{$i == 0 ? 'active' : ''}}">
                                        <img style="height: 500px" src="{{
                                                !empty($arrPostPage['section4'][$i]->image_path) ? $arrPostPage['section4'][$i]->image_path : asset('/images/no-image.jpg')
                                                    }}" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block content-slider">
                                            <div class="card-content row">
                                                <div class="content col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <h5>
                                                        <a href="">
                                                            {{$arrPostPage['section4'][$i]->title}}
                                                        </a>
                                                    </h5>
                                                    <p> {!!encoded_substr(strip_tags_content($arrPostPage['section4'][$i]->content), 0 ,100).'......'!!}</p>
                                                </div>
                                                <div class="content-right col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="context">
                                                        <button>
                                                            <a href="{{$arrPostPage['section4'][$i]->url}}">
                                                                XEM CHI TIẾT
                                                            </a>
                                                        </button>
                                                        <div class="div-btn-tag">
                                                            <button class="btn-tag">
                                                                <img class="icon" src="{{ asset('images/tag.png') }}" alt="tag">
                                                            </button>
                                                        </div>
                                                        <div class="div-btn-share">
                                                            <button class="btn-share">
                                                                <img class="icon" src="{{ asset('images/share.png') }}"
                                                                     alt="tag">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-5">
            <div class="section-5-content container">
                <div class="title">
                    <h5>ĐỐI TÁC TIN CẬY</h5>
                </div>
                <div class="content">
                    <div class="owl-carousel brands owl-theme">
                        @foreach($brand as $value)
                            <div class="content-item">
                                <img src="{{$value->image_path}}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    @if (session()->has('order-success'))
    toastr.success('Thành công', 'Đặt hàng thành công')
    @endif

    @if (session()->has('contact-success'))
    toastr.success('Cảm ơn bạn đã phản hồi với chúng tôi', 'Thành công')
    @endif
</script>
@endpush
