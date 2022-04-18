@extends('main')

@section('title', 'Trang chủ')


@section('content')
    <div class="home">
        <div class="banner w-100">
            <img src="{{asset('images/banner/banner.png')}}" alt="">
        </div>
        <div class="product-category">
            <div class="product-category-content container">
                <div class="title text-center">
                    <h5>DANH MỤC SẢN PHẨM</h5>
                </div>
                <div class="content row text-center">
                    <div class="product-category-item text-center col-2">
                        <div class="div-center">
                            <a href="">
                                <div class="product-category-item-content">
                                    <img src="{{asset('/images/category/1.png')}}" alt="">
                                </div>
                                <h5>Bình nóng</h5>
                            </a>
                        </div>
                    </div>
                    <div class="product-category-item text-center col-2">
                        <div class="div-center">
                            <a href="">
                                <div class="product-category-item-content">
                                    <img src="{{asset('/images/category/2.png')}}" alt="">
                                </div>
                                <h5>Năng lượng mặt trời</h5>
                            </a>
                        </div>
                    </div>
                    <div class="product-category-item text-center col-2">
                        <div class="div-center">
                            <a href="">
                                <div class="product-category-item-content">
                                    <img src="{{asset('/images/category/3.png')}}" alt="">
                                </div>
                                <h5>Vòi xịt</h5>
                            </a>
                        </div>
                    </div>
                    <div class="product-category-item text-center col-2">
                        <div class="div-center">
                            <a href="">
                                <div class="product-category-item-content">
                                    <img src="{{asset('/images/category/4.png')}}" alt="">
                                </div>
                                <h5>Sen tắm</h5>
                            </a>
                        </div>
                    </div>
                    <div class="product-category-item text-center col-2">
                        <div class="div-center">
                            <a href="">
                                <div class="product-category-item-content">
                                    <img src="{{asset('/images/category/5.png')}}" alt="">
                                </div>
                                <h5>Chậu rửa</h5>
                            </a>
                        </div>
                    </div>
                    <div class="product-category-item text-center col-2">
                        <div class="div-center">
                            <a href="">
                                <div class="product-category-item-content">
                                    <img src="{{asset('/images/category/6.png')}}" alt="">
                                </div>
                                <h5>Sản phẩm khác</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="options-3 container">
            <div class="options-3-content row">
                <div class="options-3-item col-4">
                    <div class="image">
                        <a href="">
                            <img src="{{asset('images/options-3-image/1.png')}}" alt="">
                            <div class="text-title">
                                <h5>Dịch vụ thiết kế phòng tắm</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="options-3-item col-4">
                    <div class="image">
                        <a href="">
                            <img src="{{asset('images/options-3-image/2.png')}}" alt="">
                            <div class="text-title">
                                <h5>Trung tâm chăm sóc khách hàng </h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="options-3-item col-4">
                    <div class="image">
                        <a href="">
                            <img src="{{asset('images/options-3-image/3.png')}}" alt="">
                            <div class="text-title">
                                <h5>Tại sao chọn picenza ?</h5>
                            </div>
                        </a>
                    </div>
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
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{asset('images/options-3-image/5.png')}}" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block content-slider">
                                    <div class="card-content row">
                                        <div class="content col-6">
                                            <h5>GIÁ THẦU CHO NGƯỜI MỚI BẮT ĐẦU</h5>
                                            <p>Thiết kế thẩm mỹ sạch sẽ của bộ sưu tập ModernLife có lợi ích thiết thực là dễ dàng vệ sinh hơn nhiều. </p>
                                        </div>
                                        <div class="content-right col-6">
                                            <div class="context">
                                                <button>
                                                    <a href="">
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
                                                        <img class="icon" src="{{ asset('images/share.png') }}" alt="tag">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('images/options-3-image/5.png')}}" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block content-slider">
                                    <div class="card-content row">
                                        <div class="content col-6">
                                            <h5>GIÁ THẦU CHO NGƯỜI MỚI BẮT ĐẦU</h5>
                                            <p>Thiết kế thẩm mỹ sạch sẽ của bộ sưu tập ModernLife có lợi ích thiết thực là dễ dàng vệ sinh hơn nhiều. </p>
                                        </div>
                                        <div class="content-right col-6">
                                            <div class="context">
                                                <button>
                                                    <a href="">
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
                                                        <img class="icon" src="{{ asset('images/share.png') }}" alt="tag">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('images/options-3-image/5.png')}}" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block content-slider">
                                    <div class="card-content row">
                                        <div class="content col-6">
                                            <h5>GIÁ THẦU CHO NGƯỜI MỚI BẮT ĐẦU</h5>
                                            <p>Thiết kế thẩm mỹ sạch sẽ của bộ sưu tập ModernLife có lợi ích thiết thực là dễ dàng vệ sinh hơn nhiều. </p>
                                        </div>
                                        <div class="content-right col-6">
                                            <div class="context">
                                                <button>
                                                    <a href="">
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
                                                        <img class="icon" src="{{ asset('images/share.png') }}" alt="tag">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-5">
            <div class="section-5-content container">
                <div class="title">
                    <h5>CÁC THƯƠNG HIỆU</h5>
                </div>
                <div class="content row">
                    <div class="content-item column-5">
                        <img src="{{asset('images/brand/1.png')}}" alt="">
                    </div>
                    <div class="content-item column-5">
                        <img src="{{asset('images/brand/2.png')}}" alt="">
                    </div>
                    <div class="content-item column-5">
                        <img src="{{asset('images/brand/3.png')}}" alt="">
                    </div>
                    <div class="content-item column-5">
                        <img src="{{asset('images/brand/4.png')}}" alt="">
                    </div>
                    <div class="content-item column-5">
                        <img src="{{asset('images/brand/5.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
