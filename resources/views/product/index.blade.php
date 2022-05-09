@extends('main')

@section('title', 'Sản phẩm')

@section('scripts')
    <script src="{{asset('js/owl.carousel.js')}}"></script>
@endsection

@section('content')
    <div class="main-product-show">
        <div class="banner-div">
            <div class="banner">
                <img src="{{asset('images/banner/banner_2.png')}}" alt="">
                <div class="title">
                    <h4>{{$category->name}}</h4>
                    <p>{{$category->description}}</p>
                    <div class="button-product">
                        <button>
                            <a href="/danh-muc/{{$category->seo_url}}">MUA TẤT CẢ SẢN PHẨM</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-product-content-show">
            <div class="content-1 container">
                <div class="content-1-main">
                    <div class="title">
                        <h5>MUA SẮM THEO TÍNH NĂNG YÊU THÍCH</h5>
                    </div>
                    <div class="feature">
                        <div class="feature-item row">
                            @foreach($favourite as $item)
                                <div class="feature-item-main col-6 col-sm-6 col-md-4 col-lg-4">
                                    <a href="{{$item->url}}">
                                        <div class="image">
                                            <img src="{{$item->avatar}}" alt="">
                                        </div>
                                        <div class="title">
                                            <h5 class="text-uppercase">{{$item->name}}</h5>
                                        </div>
                                        <div class="sub-title">
                                            <p>{{$item->short_desc}}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider-box">
            <div class="slider-box-main container">
                <div class="row w-100">
                    <div class="content-slider col-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="slider-show">
                            @for($i = 0; $i < count($product); $i++)
                                <div class="mySlides">
                                    <div class="numbertext">{{$i + 1}} / {{count($product)}}</div>
                                    <img class="demo cursor" src="{{(!empty($product[$i]->avatar_path))  ? $product[$i]->avatar_path : asset('/images/no-image.jpg')  }}"
                                         style="width:100%; height: 473px; object-fit: contain" onclick="currentSlide(1)" alt="The Woods1">
                                </div>
                            @endfor
                            <a class="prev" onclick="plusSlides(-1)">❮</a>
                            <a class="next" onclick="plusSlides(1)">❯</a>
                            <div class="list-dots" style="text-align:center">
                                <?php $i2 = 0; ?>
                                @foreach($product as $item)
                                        <?php $i2++ ?>
                                    <a href="javascript:void(0)" class="dot" onclick="currentSlide({{$i2}})" title="slide {{$i2}}"></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="caption-container col-12 col-sm-12 col-md-4 col-lg-4">
                        {{--                    <p id="caption"></p>--}}

                        <div class="content-sl text-center" id="content-slide-show">
                            <?php $i = 0; ?>
                            @foreach($product as $item)
                                <?php $i++ ?>
                                @if($i == 1)
                                    <div class="content-sl-main" id="content-sl-main" style="display:block;">
                                        <div class="title">
                                            <h5>{{$item->name}}</h5>
                                        </div>
                                        <div class="sub-title">
                                            <p>{{$item->short_desc}}</p>
                                        </div>
                                        <div class="button-buy">
                                            <button>
                                                <a href="{{config('app.url').'/chi-tiet-san-pham/'.$item->id}}">MUA NGAY</a>
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    <div class="content-sl-main" id="content-sl-main" style="display:none;">
                                        <div class="title">
                                            <h5>{{$item->name}}</h5>
                                        </div>
                                        <div class="sub-title">
                                            <p>{{$item->short_desc}}</p>
                                        </div>
                                        <div class="button-buy">
                                            <button>
                                                <a href="{{config('app.url').'/chi-tiet-san-pham/'.$item->id}}">MUA NGAY</a>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="main-product-content-show content-2">
            <div class="content-1 container">
                <div class="content-1-main">
                    <div class="title">
                        <h5 style="text-transform: uppercase;">{{$category->name}} BÁN CHẠY NHẤT</h5>
                    </div>
                    <div class="feature">
                        <div class="feature-item row owl-carousel bestseller owl-theme">
                            @foreach ($aryBestSeller as $item)
                                <div class="feature-item-main">
                                    <a href="{{ route('product.detail', $item->id) }}">
                                        <div class="image">
                                            <img
                                                src="{{ count($item->productImage) > 0 ? asset($item->productImage[0]->image_path) : asset('images/product/c.png') }}"
                                                alt="">
                                        </div>
                                        <div class="title">
                                            <h5 class="text-uppercase">{{ $item->name }}</h5>
                                        </div>
                                    </a>
                                    <div class="sub-title">
                                        <p>{{ $item->short_desc }}</p>
                                    </div>
                                    <div class="price">
                                        <text id="bind-price">@money($item->price)</text>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-product-content-show content-2">
            <div class="content-1 container">
                <div class="content-1-main">
                    <div class="title">
                        <h5>PHỤ KIỆN NHÀ VỆ SINH</h5>
                    </div>
                    <div class="feature">
                        <div class="feature-item row owl-carousel subcate owl-theme">
                            @foreach ($subNormalCate as $sub)
                                <div class="feature-item-main">
                                    <div class="image">
                                        <img
                                            src="{{ !empty($sub->avatar) ? $sub->avatar : asset('images/product/c.png') }}"
                                            alt="">
                                    </div>
                                    <div class="title">
                                        <h5 class="text-uppercase">{{ $sub->name }}</h5>
                                    </div>
                                    <div class="sub-title">
                                        <p>{{ $sub->short_desc }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
