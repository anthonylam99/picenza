@extends('main')

@section('title', 'Sản phẩm')

@section('content')
    <div class="main-product-show">
        <div class="banner-div">
            <div class="banner">
                <img src="{{asset('images/banner/banner_2.png')}}" alt="">
                <div class="title">
                    <h4>CHẬU RỬA</h4>
                    <p>Một loạt các sản phẩm chậu rửa mạnh mẽ sạch sẽ và hiệu quả</p>
                    <div class="button-product">
                        <button>
                            <a href="">MUA TẤT CẢ SẢN PHẨM</a>
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
                            <div class="feature-item-main col-4">
                                <div class="image">
                                    <img src="{{asset('images/feature/1.png')}}" alt="">
                                </div>
                                <div class="title">
                                    <h5 class="text-uppercase">Tự động vệ sinh liên tục</h5>
                                </div>
                                <div class="sub-title">
                                    <p>Chậu rửa tự động vệ sinh liên tục khi bẩn</p>
                                </div>
                            </div>
                            <div class="feature-item-main col-4">
                                <div class="image">
                                    <img src="{{asset('images/feature/2.png')}}" alt="">
                                </div>
                                <div class="title">
                                    <h5 class="text-uppercase">Tự động vệ sinh liên tục</h5>
                                </div>
                                <div class="sub-title">
                                    <p>Chậu rửa tự động vệ sinh liên tục khi bẩn</p>
                                </div>
                            </div>
                            <div class="feature-item-main col-4">
                                <div class="image">
                                    <img src="{{asset('images/feature/3.png')}}" alt="">
                                </div>
                                <div class="title">
                                    <h5 class="text-uppercase">Tự động vệ sinh liên tục</h5>
                                </div>
                                <div class="sub-title">
                                    <p>Chậu rửa tự động vệ sinh liên tục khi bẩn</p>
                                </div>
                            </div>
                            <div class="feature-item-main col-4">
                                <div class="image">
                                    <img src="{{asset('images/feature/4.png')}}" alt="">
                                </div>
                                <div class="title">
                                    <h5 class="text-uppercase">Tự động vệ sinh liên tục</h5>
                                </div>
                                <div class="sub-title">
                                    <p>Chậu rửa tự động vệ sinh liên tục khi bẩn</p>
                                </div>
                            </div>
                            <div class="feature-item-main col-4">
                                <div class="image">
                                    <img src="{{asset('images/feature/5.png')}}" alt="">
                                </div>
                                <div class="title">
                                    <h5 class="text-uppercase">Tự động vệ sinh liên tục</h5>
                                </div>
                                <div class="sub-title">
                                    <p>Chậu rửa tự động vệ sinh liên tục khi bẩn</p>
                                </div>
                            </div><div class="feature-item-main col-4">
                                <div class="image">
                                    <img src="{{asset('images/feature/6.png')}}" alt="">
                                </div>
                                <div class="title">
                                    <h5 class="text-uppercase">Tự động vệ sinh liên tục</h5>
                                </div>
                                <div class="sub-title">
                                    <p>Chậu rửa tự động vệ sinh liên tục khi bẩn</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider-box">
            <div class="slider-box-main container">
                <div class="content-slider">
                    <div class="slider-show">
                        <div class="mySlides">
                            <div class="numbertext">1 / 6</div>
                            <img class="demo cursor" src="{{asset('images/banner/banner_3.png')}}" style="width:100%" onclick="currentSlide(1)" alt="The Woods1">
                        </div>

                        <div class="mySlides">
                            <div class="numbertext">2 / 6</div>
                            <img class="demo cursor" src="{{asset('images/banner/banner_3.png')}}" style="width:100%" onclick="currentSlide(1)" alt="The Woods2">
                        </div>

                        <div class="mySlides">
                            <div class="numbertext">3 / 6</div>
                            <img class="demo cursor" src="{{asset('images/banner/banner_3.png')}}" style="width:100%" onclick="currentSlide(1)" alt="The Woods3">
                        </div>

                        <div class="mySlides">
                            <div class="numbertext">4 / 6</div>
                            <img class="demo cursor" src="{{asset('images/banner/banner_3.png')}}" style="width:100%" onclick="currentSlide(1)" alt="The Woods4">
                        </div>

                        <div class="mySlides">
                            <div class="numbertext">5 / 6</div>
                            <img class="demo cursor" src="{{asset('images/banner/banner_3.png')}}" style="width:100%" onclick="currentSlide(1)" alt="The Woods5">
                        </div>

                        <div class="mySlides">
                            <div class="numbertext">6 / 6</div>
                            <img class="demo cursor" src="{{asset('images/banner/banner_3.png')}}" style="width:100%" onclick="currentSlide(1)" alt="The Woods6">
                        </div>

                        <a class="prev" onclick="plusSlides(-1)">❮</a>
                        <a class="next" onclick="plusSlides(1)">❯</a>
                        <div class="list-dots" style="text-align:center">
                            <a href="javascript:void(0)" class="dot" onclick="currentSlide(1)" title="slide 1"></a>
                            <a href="javascript:void(0)" class="dot" onclick="currentSlide(2)" title="slide 2"></a>
                            <a href="javascript:void(0)" class="dot" onclick="currentSlide(3)" title="slide 3"></a>
                            <a href="javascript:void(0)" class="dot" onclick="currentSlide(4)" title="slide 4"></a>
                            <a href="javascript:void(0)" class="dot" onclick="currentSlide(5)" title="slide 4"></a>
                            <a href="javascript:void(0)" class="dot" onclick="currentSlide(6)" title="slide 4"></a>
                        </div>
                    </div>
                </div>
                <div class="caption-container">
{{--                    <p id="caption"></p>--}}
                    <div class="content-sl text-center">
                        <div class="content-sl-main">
                            <div class="title">
                                <h5>PICENZA</h5>
                            </div>
                            <div class="sub-title">
                                <p>Phong cách linh hoạt trong các loại tùy chọn một hoặc hai mảnh</p>
                            </div>
                            <div class="button-buy">
                                <button>
                                    <a href="">MUA NGAY</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-product-content-show content-2">
            <div class="content-1 container">
                <div class="content-1-main">
                    <div class="title">
                        <h5>CHẬU RỬA BÁN CHẠY NHẤT</h5>
                    </div>
                    <div class="feature">
                        <div class="feature-item row">
                            <div class="feature-item-main col-4">
                                <div class="image">
                                    <img src="{{asset('images/product/a.png')}}" alt="">
                                </div>
                                <div class="title">
                                    <h5 class="text-uppercase">Tự động vệ sinh liên tục</h5>
                                </div>
                                <div class="sub-title">
                                    <p>Chậu rửa tự động vệ sinh liên tục khi bẩn</p>
                                </div>
                            </div>
                            <div class="feature-item-main col-4">
                                <div class="image">
                                    <img src="{{asset('images/product/b.png')}}" alt="">
                                </div>
                                <div class="title">
                                    <h5 class="text-uppercase">Tự động vệ sinh liên tục</h5>
                                </div>
                                <div class="sub-title">
                                    <p>Chậu rửa tự động vệ sinh liên tục khi bẩn</p>
                                </div>
                            </div>
                            <div class="feature-item-main col-4">
                                <div class="image">
                                    <img src="{{asset('images/product/c.png')}}" alt="">
                                </div>
                                <div class="title">
                                    <h5 class="text-uppercase">Tự động vệ sinh liên tục</h5>
                                </div>
                                <div class="sub-title">
                                    <p>Chậu rửa tự động vệ sinh liên tục khi bẩn</p>
                                </div>
                            </div>
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
                        <div class="feature-item row">
                            <div class="feature-item-main col-4">
                                <div class="image">
                                    <div class="main-image">
                                        <img src="{{asset('images/product/d.png')}}" alt="">
                                    </div>
                                </div>
                                <div class="title">
                                    <h5 class="text-uppercase">Tự động vệ sinh liên tục</h5>
                                </div>
                                <div class="sub-title">
                                    <p>Chậu rửa tự động vệ sinh liên tục khi bẩn</p>
                                </div>
                            </div>
                            <div class="feature-item-main col-4">
                                <div class="image">
                                    <div class="main-image">
                                        <img src="{{asset('images/product/e.png')}}" alt="">
                                    </div>
                                </div>
                                <div class="title">
                                    <h5 class="text-uppercase">Tự động vệ sinh liên tục</h5>
                                </div>
                                <div class="sub-title">
                                    <p>Chậu rửa tự động vệ sinh liên tục khi bẩn</p>
                                </div>
                            </div>
                            <div class="feature-item-main col-4">
                                <div class="image">
                                    <div class="main-image">
                                        <img src="{{asset('images/product/f.png')}}" alt="">
                                    </div>
                                </div>
                                <div class="title">
                                    <h5 class="text-uppercase">Tự động vệ sinh liên tục</h5>
                                </div>
                                <div class="sub-title">
                                    <p>Chậu rửa tự động vệ sinh liên tục khi bẩn</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
