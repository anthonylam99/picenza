@extends('main')

@section('title', 'Chi tiết sản phẩm')
@section('font-awsomes' ,'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')
@section('scripts')
    <script src="{{asset('js/owl.carousel.js')}}"></script>
@endsection


@section('breadcrumb')
    <div class="breadcrumb-s">
        <div class="breadcrumb-s-content container middle">
            <div class="breadcrumb-content middle">
                <img width="10" height="10" src="{{ asset('images/arrow-right.png') }}" alt="tag">
                <a href="">Chậu rửa Picenza 15344A</a>
            </div>
            <div class="breadcrumb-path">
                <ul class="middle">
                    <li>
                        <a href="">Trang chủ</a> /&nbsp;
                    </li>
                    <li>
                        <a href="">Danh mục </a> /&nbsp;
                    </li>
                    <li>
                        <a href="">Chậu rửa</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="main-content-product container">
        <div class="content-1 row">
            <div class="product-image col-12 col-md-7">
                <div class="image">
                    <img src="{{ asset('images/product/product_demo.png') }}" alt="tag">
                </div>
            </div>
            <div class="product-options col-12 col-md-5">
                <div class="product-option-1">
                    <div class="product-name">
                        <h5>Chậu rửa Picenza 15344A</h5>
                    </div>
                    <div class="product-description">
                        <p>Mô tả</p>
                    </div>
                </div>
                <form action="/add-to-cart">
                    <div class="rating-star">
                        <div class="rating-group-star">
                            <div class="rating-group">
                                @if($stars['fullStar'] > 0)
                                    @for($i = 0; $i < $stars['fullStar']; $i++)
                                        <div class="star-item">
                                            <div class="icon-1">
                                                <i class="fa fa-star fa-star-active" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                                @if($stars['halfStar'] > 0)
                                    @for($i = 0; $i < $stars['halfStar']; $i++)
                                        <div class="star-item">
                                            <div class="icon-1">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <div class="icon-2">
                                                    <i class="fa fa-star-half fa-star-half-active"
                                                       aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                                @if($stars['noneStar'] > 0)
                                    @for($i = 0; $i < $stars['noneStar']; $i++)
                                        <div class="star-item">
                                            <div class="icon-1">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                                {{--                                <input class="rating__input rating__input--none"  name="rating2" id="rating2-0"--}}
                                {{--                                       value="0"--}}
                                {{--                                       type="radio">--}}
                                {{--                                <label style="display: none" aria-label="0 stars" class="rating__label" for="rating2-0"></label>--}}
                                {{--                                <label aria-label="0.5 stars" class="rating__label rating__label--half"--}}
                                {{--                                       for="rating2-05"><i--}}
                                {{--                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>--}}
                                {{--                                <input class="rating__input" name="rating2" id="rating2-05" value="0.5" type="radio">--}}
                                {{--                                <label aria-label="1 star" class="rating__label" for="rating2-10"><i--}}
                                {{--                                        class="rating__icon rating__icon--star fa fa-star"></i></label>--}}
                                {{--                                <input class="rating__input" name="rating2" id="rating2-10" value="1" type="radio">--}}
                                {{--                                <label aria-label="1.5 stars" class="rating__label rating__label--half"--}}
                                {{--                                       for="rating2-15"><i--}}
                                {{--                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>--}}
                                {{--                                <input class="rating__input" name="rating2" id="rating2-15" value="1.5" type="radio">--}}
                                {{--                                <label aria-label="2 stars" class="rating__label" for="rating2-20"><i--}}
                                {{--                                        class="rating__icon rating__icon--star fa fa-star"></i></label>--}}
                                {{--                                <input class="rating__input" name="rating2" id="rating2-20" value="2" type="radio">--}}
                                {{--                                <label aria-label="2.5 stars" class="rating__label rating__label--half"--}}
                                {{--                                       for="rating2-25"><i--}}
                                {{--                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>--}}
                                {{--                                <input class="rating__input" name="rating2" id="rating2-25" value="2.5" type="radio"--}}
                                {{--                                >--}}
                                {{--                                <label aria-label="3 stars" class="rating__label" for="rating2-30"><i--}}
                                {{--                                        class="rating__icon rating__icon--star fa fa-star"></i></label>--}}
                                {{--                                <input class="rating__input" name="rating2" id="rating2-30" value="3" type="radio">--}}
                                {{--                                <label aria-label="3.5 stars" class="rating__label rating__label--half"--}}
                                {{--                                       for="rating2-35"><i--}}
                                {{--                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>--}}
                                {{--                                <input class="rating__input" name="rating2" id="rating2-35" value="3.5" type="radio"--}}
                                {{--                                       checked>--}}
                                {{--                                <label aria-label="4 stars" class="rating__label" for="rating2-40"><i--}}
                                {{--                                        class="rating__icon rating__icon--star fa fa-star"></i></label>--}}
                                {{--                                <input class="rating__input" name="rating2" id="rating2-40" value="4" type="radio">--}}
                                {{--                                <label aria-label="4.5 stars" class="rating__label rating__label--half"--}}
                                {{--                                       for="rating2-45"><i--}}
                                {{--                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>--}}
                                {{--                                <input class="rating__input" name="rating2" id="rating2-45" value="4.5" type="radio">--}}
                                {{--                                <label aria-label="5 stars" class="rating__label" for="rating2-50"><i--}}
                                {{--                                        class="rating__icon rating__icon--star fa fa-star"></i></label>--}}
                                {{--                                <input class="rating__input" name="rating2" id="rating2-50" value="5" type="radio">--}}
                            </div>
                            <div class="rating-point-and-quantity">
                                <div class="rating-point">{{$starReviewPoint}}</div>
                                <div class="rating-quantity">(35)</div>
                            </div>
                        </div>
                        <div class="write-comment">
                            <button>
                                <a href="#comment">Viết nhận xét</a>
                            </button>
                        </div>
                    </div>
                    <div class="product-price">
                        <div class="price">
                            <h5>Giá niêm yết:
                                <text>1.000.000 VNĐ</text>
                            </h5>
                        </div>
                        <div class="price-description">
                            <p>Sử dụng mã <b>SPRING</b> khi thanh toán để nhận giảm giá 25% cho toàn bộ đơn đặt hàng của
                                bạn
                                mã phiếu giảm giá chỉ có giá trị đối với các mặt hàng có giá đầy đủ.</p>
                        </div>
                    </div>
                    <div class="product-color">
                        <div class="color-option">
                            <h6>MÀU SẮC:
                                <text class="color">Trắng</text>
                            </h6>
                        </div>
                        <div class="color-options-select">
                            @foreach($colors as $color)
                                <input class="color-options"
                                       onClick="changeColor({{$color['id']}}, '{{$color['color']}}')" type="button"
                                       style="background-color: {{$color['hex']}}"></input>
                            @endforeach
                            <input type="hidden" id="color-selected" value="1" name="color"/>
                        </div>
                    </div>
                    <div class="product-quantity-addcart">
                        <div class="quantity">
                            <input type="number" name="quantity" value="1">
                        </div>
                        <div class="addcart col-9">
                            <button type="submit" class="btn btn_add_cart btn-cart add_to_cart">
                                THÊM VÀO GIỎ HÀNG
                            </button>
                        </div>
                    </div>
                    <div class="compare-product">
                        <div class="div-btn-compare">
                            <button class="btn-compare w-100">
                                + SO SÁNH
                            </button>
                        </div>
                        <div class="div-btn-tag">
                            <button class="btn-tag w-100">
                                <img src="{{ asset('images/tag.png') }}" alt="tag">
                            </button>
                        </div>
                        <div class="div-btn-print">
                            <button class="btn-print w-100">
                                <img src="{{ asset('images/printer.png') }}" alt="tag">
                            </button>
                        </div>
                        <div class="div-btn-share">
                            <button class="btn-share w-100">
                                <img src="{{ asset('images/share.png') }}" alt="tag">
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="product-description">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                            Đặc trưng Chậu rửa Picenza 15344A
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                         data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion
                            body.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                aria-controls="flush-collapseTwo">
                            Sự chỉ rõ
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                         data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion
                            body. Let's imagine this being filled with some actual content.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree" aria-expanded="false"
                                aria-controls="flush-collapseThree">
                            Cài đặt
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                         aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion
                            body. Nothing more exciting happening here in terms of content, but just filling up the
                            space to make it look, at least at first glance, a bit more representative of how this would
                            look in a real-world application.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseFour" aria-expanded="false"
                                aria-controls="flush-collapseFour">
                            Bộ phận & Hỗ trợ
                        </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                         data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion
                            body. Nothing more exciting happening here in terms of content, but just filling up the
                            space to make it look, at least at first glance, a bit more representative of how this would
                            look in a real-world application.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-relate-to">
            <div class="title-main">
                <div class="title">
                    <h6>SẢN PHẨM LIÊN QUAN</h6>
                </div>
            </div>
            <div class="content w-100">
                <div class="owl-carousel product-relate owl-theme">

                    <div class="product-relate-item-main">
                        <div class="product-relate-item">
                            <div class="image">
                                <a href="">
                                    <img src="{{ asset('images/product/product_demo_2.png') }}" alt="tag">
                                </a>
                            </div>
                            <div class="name">
                                <h6>
                                    <a href="">Bình lọc tổng hikarix SH-1500</a>
                                </h6>
                            </div>
                            <div class="price">
                                <div class="content-price">
                                    <h6 class="sale-price">1.000.000đ</h6>
                                    <h6 class="unsale-price">1.200.000đ</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-relate-item-main">
                        <div class="product-relate-item">
                            <div class="image">
                                <a href="">
                                    <img src="{{ asset('images/product/product_demo_2.png') }}" alt="tag">
                                </a>
                            </div>
                            <div class="name">
                                <h6>
                                    <a href="">Bình lọc tổng hikarix SH-1500</a>
                                </h6>
                            </div>
                            <div class="price">
                                <div class="content-price">
                                    <h6 class="sale-price">1.000.000đ</h6>
                                    <h6 class="unsale-price">1.200.000đ</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-relate-item-main">
                        <div class="product-relate-item">
                            <div class="image">
                                <a href="">
                                    <img src="{{ asset('images/product/product_demo_2.png') }}" alt="tag">
                                </a>
                            </div>
                            <div class="name">
                                <h6>
                                    <a href="">Bình lọc tổng hikarix SH-1500</a>
                                </h6>
                            </div>
                            <div class="price">
                                <div class="content-price">
                                    <h6 class="sale-price">1.000.000đ</h6>
                                    <h6 class="unsale-price">1.200.000đ</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-relate-item-main">
                        <div class="product-relate-item">
                            <div class="image">
                                <a href="">
                                    <img src="{{ asset('images/product/product_demo_2.png') }}" alt="tag">
                                </a>
                            </div>
                            <div class="name">
                                <h6>
                                    <a href="">Bình lọc tổng hikarix SH-1500</a>
                                </h6>
                            </div>
                            <div class="price">
                                <div class="content-price">
                                    <h6 class="sale-price">1.000.000đ</h6>
                                    <h6 class="unsale-price">1.200.000đ</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="review">
            <div class="review-content-1">
                <div class="review-1">
                    <div class="rating-star">
                        <div class="rating-group-star">
                            <div class="rating-group">
                                @if($stars['fullStar'] > 0)
                                    @for($i = 0; $i < $stars['fullStar']; $i++)
                                        <div class="star-item">
                                            <div class="icon-1">
                                                <i class="fa fa-star fa-star-active" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                                @if($stars['halfStar'] > 0)
                                    @for($i = 0; $i < $stars['halfStar']; $i++)
                                        <div class="star-item">
                                            <div class="icon-1">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <div class="icon-2">
                                                    <i class="fa fa-star-half fa-star-half-active"
                                                       aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                                @if($stars['noneStar'] > 0)
                                    @for($i = 0; $i < $stars['noneStar']; $i++)
                                        <div class="star-item">
                                            <div class="icon-1">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            </div>
                            <div class="rating-point-and-review">
                                <div class="rating-point">{{$starReviewPoint}} |
                                    <text>49 đánh giá</text>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="review-2">
                    <h6>
                        42 trong số 45 (93%) người đánh giá giới thiệu sản phẩm này
                    </h6>
                </div>
            </div>
            <div class="review-content-2">
                <div class="content-btn">
                    <input type="text" name="search-review" value="Tìm kiếm bài viết và review">
                    <button type="submit">
                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                             width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000"
                             preserveAspectRatio="xMidYMid meet">

                            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                               fill="#FFFFFF" stroke="none">
                                <path d="M1940 5079 c-493 -25 -971 -242 -1334 -605 -295 -295 -496 -674 -570
                                    -1075 -168 -910 277 -1807 1104 -2228 454 -231 994 -284 1489 -145 177 50 429
                                    163 557 252 l59 40 605 -602 c546 -545 611 -606 670 -635 305 -147 651 109
                                    591 437 -24 130 -23 129 -680 786 l-608 608 82 161 c138 272 201 499 226 802
                                    44 550 -154 1119 -535 1533 -193 211 -404 365 -661 484 -154 71 -211 92 -354
                                    128 -214 54 -401 71 -641 59z m355 -684 c555 -91 1005 -512 1133 -1060 108
                                    -461 -25 -943 -353 -1284 -270 -280 -622 -431 -1007 -431 -371 0 -721 146
                                    -987 411 -196 197 -323 433 -383 712 -31 146 -31 399 1 546 82 384 296 696
                                    621 906 166 108 344 172 570 208 66 11 323 6 405 -8z"/>
                            </g>
                        </svg>

                    </button>
                </div>
            </div>
        </div>
        <div class="list-of-review row" id="comment">
            <div class="review-title col-md-9 col-12">
                <h5>NHẬN XÉT</h5>
                <h6>Ảnh chụp nhanh xếp hạng</h6>
                <h6>Chọn một hàng bên dưới để lọc đánh giá</h6>
                <div class="review-list">
                    <div class="review-item">
                        <p>5★</p>
                        <div class="review-scale">
                            <button style="margin: 0; padding: 0; border: none; outline: none;">
                                <div class="scale-100" style="position: relative; width: 300px; height: 10px;">
                                    <div class="scale-percent"
                                         style="
                                         position: absolute;
                                         width: {{(50/100) * 100}}%;
                                         background-color: #F31C1C;
                                         z-index: 10;
                                         height: 10px;
                                         left: 0;">
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div class="review-slg">
                            <div class="ctn">
                                41
                            </div>
                        </div>
                    </div>
                    <div class="review-item">
                        <p>4★</p>
                        <div class="review-scale">
                            <button style="margin: 0; padding: 0; border: none; outline: none;">
                                <div class="scale-100" style="position: relative; width: 300px; height: 10px;">
                                    <div class="scale-percent"
                                         style="
                                         position: absolute;
                                         width: {{(40/100) * 100}}%;
                                         background-color: #F31C1C;
                                         z-index: 10;
                                         height: 10px;
                                         left: 0;">
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div class="review-slg">
                            <div class="ctn">
                                41
                            </div>
                        </div>
                    </div>
                    <div class="review-item">
                        <p>3★</p>
                        <div class="review-scale">
                            <button style="margin: 0; padding: 0; border: none; outline: none;">
                                <div class="scale-100" style="position: relative; width: 300px; height: 10px;">
                                    <div class="scale-percent"
                                         style="
                                         position: absolute;
                                         width: {{(30/100) * 100}}%;
                                         background-color: #F31C1C;
                                         z-index: 10;
                                         height: 10px;
                                         left: 0;">
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div class="review-slg">
                            <div class="ctn">
                                41
                            </div>
                        </div>
                    </div>
                    <div class="review-item">
                        <p>2★</p>
                        <div class="review-scale">
                            <button style="margin: 0; padding: 0; border: none; outline: none;">
                                <div class="scale-100" style="position: relative; width: 300px; height: 10px;">
                                    <div class="scale-percent"
                                         style="
                                         position: absolute;
                                         width: {{(20/100) * 100}}%;
                                         background-color: #F31C1C;
                                         z-index: 10;
                                         height: 10px;
                                         left: 0;">
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div class="review-slg">
                            <div class="ctn">
                                41
                            </div>
                        </div>
                    </div>
                    <div class="review-item">
                        <p>1★</p>
                        <div class="review-scale">
                            <button style="margin: 0; padding: 0; border: none; outline: none;">
                                <div class="scale-100" style="position: relative; width: 300px; height: 10px;">
                                    <div class="scale-percent"
                                         style="
                                         position: absolute;
                                         width: {{(10/100) * 100}}%;
                                         background-color: #F31C1C;
                                         z-index: 10;
                                         height: 10px;
                                         left: 0;">
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div class="review-slg">
                            <div class="ctn">
                                41
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="write-cmt col-md-3 col-12">
                <button class="write">
                    Viết nhận xét
                </button>
                <div class="rank">
                    <div class="rank-title">
                        Xếp hạng trung bình
                    </div>
                    <div class="content-rank">
                        <div class="total">
                            <h6>Tổng thể</h6>
                            <div class="rating-star">
                                <div class="rating-group-star">
                                    <div class="rating-group">
                                        <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                               for="rating2-05"><i
                                                class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating4" id="rating4-05" value="0.5"
                                               type="radio">
                                        <label aria-label="1 star" class="rating__label" for="rating4-10"><i
                                                class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating4" id="rating4-10" value="1"
                                               type="radio">
                                        <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                               for="rating2-15"><i
                                                class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating4" id="rating4-15" value="1.5"
                                               type="radio">
                                        <label aria-label="2 stars" class="rating__label" for="rating4-20"><i
                                                class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating4" id="rating4-20" value="2"
                                               type="radio">
                                        <label aria-label="2.5 stars" class="rating__label rating__label--half"
                                               for="rating2-25"><i
                                                class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating4" id="rating4-25" value="2.5"
                                               type="radio"
                                        >
                                        <label aria-label="3 stars" class="rating__label" for="rating4-30"><i
                                                class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating4" id="rating4-30" value="3"
                                               type="radio">
                                        <label aria-label="3.5 stars" class="rating__label rating__label--half"
                                               for="rating2-35"><i
                                                class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating4" id="rating4-35" value="3.5"
                                               type="radio"
                                               checked>
                                        <label aria-label="4 stars" class="rating__label" for="rating4-40"><i
                                                class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating4" id="rating4-40" value="4"
                                               type="radio">
                                        <label aria-label="4.5 stars" class="rating__label rating__label--half"
                                               for="rating2-45"><i
                                                class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                        <input class="rating__input" name="rating4" id="rating4-45" value="4.5"
                                               type="radio">
                                        <label aria-label="5 stars" class="rating__label" for="rating4-50"><i
                                                class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        <input class="rating__input" name="rating4" id="rating4-50" value="5"
                                               type="radio">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="quality">
                            <h6>Chất lượng</h6>
                            <div class="point-group">
                                <div class="point-item">
                                    <div class="point point-active"></div>
                                    <div class="point point-active"></div>
                                    <div class="point point-active"></div>
                                    <div class="point point-active"></div>
                                    <div class="point point-unactive"></div>
                                </div>
                            </div>
                        </div>
                        <div class="value">
                            <h6>Giá trị</h6>
                            <div class="point-group">
                                <div class="point-item">
                                    <div class="point point-active"></div>
                                    <div class="point point-active"></div>
                                    <div class="point point-active"></div>
                                    <div class="point point-active"></div>
                                    <div class="point point-unactive"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="review-detail">
            <div class="review-detail-title">
                <div class="number-review">
                    <h6>1-3 trong 49 đánh giá</h6>
                </div>
                <div class=orders>
                    <div class="order-by-title">
                        Sắp xếp theo:
                    </div>
                    <div class="order-by-btn">
                        <select name="orderby" id="orderby">
                            <option value="1">Liên quan nhất</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="review-detail-content">
                <div class="review-item row">
                    <div class="customer-info col-sm-3 col-12">
                        <div class="name">Nguyễn Vân Anh</div>
                        <div class="address">Đông Anh, Hà Nội</div>
                        <div class="comment">Bình luận: 1</div>
                        <div class="has-review">Đã đánh giá: 61</div>
                        <div class="gender">Giới tính: Nữ</div>
                        <div class="age">Tuổi: 35-44</div>
                    </div>
                    <div class="review-content col-sm-6 col-12">
                        <div class="rating-star">
                            <i class="fa fa-star" style="color: #ED2027; "></i>
                            <i class="fa fa-star" style="color: #ED2027; "></i>
                            <i class="fa fa-star" style="color: #ED2027; "></i>
                            <i class="fa fa-star" style="color: #ED2027; "></i>
                            <i class="fa fa-star" style="color: #DBDBDB;"></i>
                            <i class="fa fa-circle" style="font-size: 4px; padding: 0 10px; color: #444444;"></i>
                            <div class="dot">
                                <h6 class="timer">15 phút trước</h6>
                            </div>
                        </div>
                        <div class="review-title">
                            <h6>Bồn cấu toilet sang trọng , đẹp !</h6>
                        </div>
                        <div class="review-main-content">
                            <div class="content-1">
                                <p>
                                    There are several things I love about this toilet!!!
                                    First, the base is smooth. Not a lot of dips,
                                    and places for dirt and dust to collect.
                                    No one likes cleaning the toilet. We all do it,
                                    but no one likes it. This helps so much!!
                                    The force flush help avoid that yucky ring near the top of
                                    the bowl, that always sneaks up on me in the average toilet. A
                                    lso, you can use any brand of toilet tab. There is not a specif
                                    ic one that works. Which I love! This toilet sits a bit taller than
                                    our other toilets. Which I will not complain about at all. It is one of th
                                    ose features you don't realize is a plus, until you have it. I am in my 40's,
                                    and that little raise makes a difference. But it is still low enough for my young
                                    chil
                                    dren to use comfortably. While this is not 100% self cleaning toilet, you still need
                                    do some cleaning, it is incredibly helpful. I could not be happier.
                                </p>
                            </div>
                            <div class="content-2">
                                <div class="review-useful">
                                    <h6>Đánh giá sản phẩm này
                                        <text>✔ Hữu ích</text>
                                    </h6>
                                </div>
                                <div class="review-image row">
                                    <div class="col-3">
                                        <img src="{{asset('/images/product/Rectangle 1480.png')}}" alt="">
                                    </div>
                                    <div class="col-3">
                                        <img src="{{asset('/images/product/Rectangle 1481.png')}}" alt="">
                                    </div>
                                    <div class="col-3">
                                        <img src="{{asset('/images/product/Rectangle 1482.png')}}" alt="">
                                    </div>
                                    <div class="col-3">
                                        <img src="{{asset('/images/product/Rectangle 1483.png')}}" alt="">
                                    </div>
                                </div>
                                <div class="make-review-useful">
                                    <h6>Hữu ích ?</h6>
                                    <button class="useful">
                                        Có
                                        <i class="fa fa-circle"
                                           style="font-size: 4px; padding: 0 4px; color: #444444;"></i>
                                        <text>32</text>
                                    </button>
                                    <button class="unuseful">
                                        Không
                                        <i class="fa fa-circle"
                                           style="font-size: 4px; padding: 0 4px; color: #444444;"></i>
                                        <text>32</text>
                                    </button>
                                    <button class="report">
                                        Báo cáo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="review-quality col-sm-3 col-12">
                        <div class="review-quality-content">
                            <div class="quality">
                                <h6>Chất lượng</h6>
                                <div class="point-group">
                                    <div class="point-item">
                                        <i class="point point-active"></i>
                                        <i class="point point-active"></i>
                                        <i class="point point-active"></i>
                                        <i class="point point-active"></i>
                                        <i class="point point-unactive"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="value">
                                <h6>Giá trị</h6>
                                <div class="point-group">
                                    <div class="point-item">
                                        <div class="point point-active"></div>
                                        <div class="point point-active"></div>
                                        <div class="point point-active"></div>
                                        <div class="point point-active"></div>
                                        <div class="point point-unactive"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="review-item row">
                    <div class="customer-info col-sm-3 col-12">
                        <div class="name">Nguyễn Vân Anh</div>
                        <div class="address">Đông Anh, Hà Nội</div>
                        <div class="comment">Bình luận: 1</div>
                        <div class="has-review">Đã đánh giá: 61</div>
                        <div class="gender">Giới tính: Nữ</div>
                        <div class="age">Tuổi: 35-44</div>
                    </div>
                    <div class="review-content col-sm-6 col-12">
                        <div class="rating-star">
                            <i class="fa fa-star" style="color: #ED2027; "></i>
                            <i class="fa fa-star" style="color: #ED2027; "></i>
                            <i class="fa fa-star" style="color: #ED2027; "></i>
                            <i class="fa fa-star" style="color: #ED2027; "></i>
                            <i class="fa fa-star" style="color: #DBDBDB;"></i>
                            <i class="fa fa-circle" style="font-size: 4px; padding: 0 10px; color: #444444;"></i>
                            <div class="dot">
                                <h6 class="timer">15 phút trước</h6>
                            </div>
                        </div>
                        <div class="review-title">
                            <h6>Bồn cấu toilet sang trọng , đẹp !</h6>
                        </div>
                        <div class="review-main-content">
                            <div class="content-1">
                                <p>
                                    There are several things I love about this toilet!!!
                                    First, the base is smooth. Not a lot of dips,
                                    and places for dirt and dust to collect.
                                    No one likes cleaning the toilet. We all do it,
                                    but no one likes it. This helps so much!!
                                    The force flush help avoid that yucky ring near the top of
                                    the bowl, that always sneaks up on me in the average toilet. A
                                    lso, you can use any brand of toilet tab. There is not a specif
                                    ic one that works. Which I love! This toilet sits a bit taller than
                                    our other toilets. Which I will not complain about at all. It is one of th
                                    ose features you don't realize is a plus, until you have it. I am in my 40's,
                                    and that little raise makes a difference. But it is still low enough for my young
                                    chil
                                    dren to use comfortably. While this is not 100% self cleaning toilet, you still need
                                    do some cleaning, it is incredibly helpful. I could not be happier.
                                </p>
                            </div>
                            <div class="content-2">
                                <div class="review-useful">
                                    <h6>Đánh giá sản phẩm này
                                        <text>✔ Hữu ích</text>
                                    </h6>
                                </div>
                                <div class="review-image row">
                                    <div class="col-3">
                                        <img src="{{asset('/images/product/Rectangle 1480.png')}}" alt="">
                                    </div>
                                    <div class="col-3">
                                        <img src="{{asset('/images/product/Rectangle 1481.png')}}" alt="">
                                    </div>
                                    <div class="col-3">
                                        <img src="{{asset('/images/product/Rectangle 1482.png')}}" alt="">
                                    </div>
                                    <div class="col-3">
                                        <img src="{{asset('/images/product/Rectangle 1483.png')}}" alt="">
                                    </div>
                                </div>
                                <div class="make-review-useful">
                                    <h6>Hữu ích ?</h6>
                                    <button class="useful">
                                        Có
                                        <i class="fa fa-circle"
                                           style="font-size: 4px; padding: 0 4px; color: #444444;"></i>
                                        <text>32</text>
                                    </button>
                                    <button class="unuseful">
                                        Không
                                        <i class="fa fa-circle"
                                           style="font-size: 4px; padding: 0 4px; color: #444444;"></i>
                                        <text>32</text>
                                    </button>
                                    <button class="report">
                                        Báo cáo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="review-quality col-sm-3 col-12">
                        <div class="review-quality-content">
                            <div class="quality">
                                <h6>Chất lượng</h6>
                                <div class="point-group">
                                    <div class="point-item">
                                        <i class="point point-active"></i>
                                        <i class="point point-active"></i>
                                        <i class="point point-active"></i>
                                        <i class="point point-active"></i>
                                        <i class="point point-unactive"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="value">
                                <h6>Giá trị</h6>
                                <div class="point-group">
                                    <div class="point-item">
                                        <div class="point point-active"></div>
                                        <div class="point point-active"></div>
                                        <div class="point point-active"></div>
                                        <div class="point point-active"></div>
                                        <div class="point point-unactive"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-load-more text-center">
                <button class="load-more">
                    Xem thêm <i class="fa fa-long-arrow-right"></i>
                </button>
            </div>
        </div>
        <div class="product-recent">
            <div class="title-main">
                <div class="title">
                    <h6>SẢN PHẨM ĐÃ XEM GẦN ĐÂY</h6>
                </div>
            </div>
            <div class="content w-100">
                <div class="owl-carousel product-recent owl-theme">
                    <div class="product-relate-item-main">
                        <div class="product-relate-item">
                            <div class="image">
                                <a href="">
                                    <img src="{{ asset('images/product/product_demo_2.png') }}" alt="tag">
                                </a>
                            </div>
                            <div class="name">
                                <h6>
                                    <a href="">Bình lọc tổng hikarix SH-1500</a>
                                </h6>
                            </div>
                            <div class="price">
                                <div class="content-price">
                                    <h6 class="sale-price">1.000.000đ</h6>
                                    <h6 class="unsale-price">1.200.000đ</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-relate-item-main">
                        <div class="product-relate-item">
                            <div class="image">
                                <a href="">
                                    <img src="{{ asset('images/product/product_demo_2.png') }}" alt="tag">
                                </a>
                            </div>
                            <div class="name">
                                <h6>
                                    <a href="">Bình lọc tổng hikarix SH-1500</a>
                                </h6>
                            </div>
                            <div class="price">
                                <div class="content-price">
                                    <h6 class="sale-price">1.000.000đ</h6>
                                    <h6 class="unsale-price">1.200.000đ</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-relate-item-main">
                        <div class="product-relate-item">
                            <div class="image">
                                <a href="">
                                    <img src="{{ asset('images/product/product_demo_2.png') }}" alt="tag">
                                </a>
                            </div>
                            <div class="name">
                                <h6>
                                    <a href="">Bình lọc tổng hikarix SH-1500</a>
                                </h6>
                            </div>
                            <div class="price">
                                <div class="content-price">
                                    <h6 class="sale-price">1.000.000đ</h6>
                                    <h6 class="unsale-price">1.200.000đ</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-relate-item-main">
                        <div class="product-relate-item">
                            <div class="image">
                                <a href="">
                                    <img src="{{ asset('images/product/product_demo_2.png') }}" alt="tag">
                                </a>
                            </div>
                            <div class="name">
                                <h6>
                                    <a href="">Bình lọc tổng hikarix SH-1500</a>
                                </h6>
                            </div>
                            <div class="price">
                                <div class="content-price">
                                    <h6 class="sale-price">1.000.000đ</h6>
                                    <h6 class="unsale-price">1.200.000đ</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

