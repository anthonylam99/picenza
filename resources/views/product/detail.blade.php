@extends('main')

@section('title', 'Chi tiết sản phẩm')
@section('font-awsomes' ,'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')
@section('scripts')
    <script src="{{asset('js/owl.carousel.js')}}"></script>
@endsection


@section('seo')
    @if(!empty($detailProduct->seo_title))
        <meta name="title" content="{{$detailProduct->seo_title}}">
    @else
        <meta name="title" content="{{$detailProduct->name}}">
    @endif
    @if(!empty($detailProduct->seo_description))
        <meta name="description" content="{{$detailProduct->seo_description}}">
    @endif
    @if(!empty($detailProduct->seo_keyword))
        <meta name="keywords" content="{{$detailProduct->seo_keyword}}">
    @endif
    @if(!empty($detailProduct->seo_robots))
        <meta name="robots" content="{{$detailProduct->seo_robots}}">
    @endif
    @if(!empty($detailProduct->avatar_path))
        <meta name="image" content="{{$detailProduct->avatar_path}}">
        <meta property="og:image" content="{{$detailProduct->avatar_path}}">
    @endif
@endsection

@section('logo')
    <div class="img-logo" style="display: none">
        <img src="{{$detailProduct->avatar_path}}" alt="tag">
    </div>
@endsection

@section('breadcrumb')
    <div class="breadcrumb-s">
        <div class="breadcrumb-s-content container middle">
            <div class="breadcrumb-content middle">
                <img width="10" height="10" src="{{ asset('images/arrow-right.png') }}" alt="tag">
                <a href="">{{ $detailProduct->name }}</a>
            </div>
            <div class="breadcrumb-path">
                <ul class="middle">
                    <li>
                        <a href="/">Trang chủ</a> /&nbsp;
                    </li>
                    <li>
                        <a href="/danh-muc/{{$category}}">Danh mục </a> /&nbsp;
                    </li>
                    <li>
                        <a href="">{{$category->name}}</a>
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
                <div class="image" id="img-product-color">
                    {{--                    <img style="height: 350px !important;" src="{{ count($detailProduct->productImage) > 0 ? asset($detailProduct->productImage[0]->image_path) : asset('images/no-image.jpg') }}" alt="tag">--}}
                    <?php $i = 0; ?>
                    @foreach($detailProduct->productImage as $image)
                        <?php $i++; ?>
                        @if($i == 1)
                            <img class="image-product" style="display: block"
                                 src="{{ asset($image->image_path) }}" alt="tag">
                        @else
                            <img class="image-product" style="display: none"
                                 src="{{ asset($image->image_path) }}" alt="tag">
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="product-options col-12 col-md-5">
                <div class="product-option-1">
                    <div class="product-name">
                        <h5>{{ $detailProduct->name }}</h5>
                    </div>
                    <div class="product-description">
                        <p>Mô tả</p>
                    </div>
                </div>
                <form action="{{ route('addToCart') }}" method="POST" id="form-addcart">
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
                            <div class="rating-point-and-quantity">
                                <div class="rating-point">{{ $starReviewPoint > 0 ? $starReviewPoint : '' }}</div>
                                <div class="rating-quantity">({{ $aryComments->total() }})</div>
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
                                <text id="bind-price">@money($detailProduct->price)</text>
                            </h5>
                        </div>
                        <div class="price-description">
                            {!! $detailProduct->short_desc !!}
                        </div>
                    </div>
                    <div class="product-color">
                        <div class="color-option">
                            <h6>MÀU SẮC:
                                <text class="color">
                                    @php
                                        $firstColor = count($detailProduct->productImage) > 0 ? $detailProduct->productImage[0]->color : 1;
                                        $getColor = get_color_from_id($firstColor);
                                    @endphp
                                    {{ $getColor->color }}
                                </text>
                            </h6>
                        </div>
                        <div class="color-options-select">
                            @if (count($detailProduct->productImage) > 0)
                                <?php $i = 0; ?>
                                @foreach($detailProduct->productImage as $imageColor)
                                    <?php $i++; ?>
                                    @php
                                        $detailColor = get_color_from_id($imageColor->color);
                                    @endphp
                                    <input class="color-options"
                                           onClick="changeColor({{ $i }},{{ $detailColor->id }}, '{{ $detailColor->color }}', '{{ $detailProduct->id }}', '{{ $imageColor->price }}')"
                                           type="button"
                                           style="background-color: {{ $detailColor->hex }}"></input>
                                @endforeach
                                <input type="hidden" id="color-selected"
                                       value="{{$detailProduct->productImage[0]->color}}" name="color"/>
                            @endif

                        </div>
                    </div>
                    <div class="product-quantity-addcart">
                        @csrf
                        <input type="hidden" value="{{ $detailProduct->id }}" name="id"/>
                        <input type="hidden" value="{{ $detailProduct->name }}" name="name"/>
                        <input type="hidden" id="hidden-price" value="{{ $detailProduct->price }}" name="price"/>
                        <input type="hidden" value="0" name="weight"/>
                        <input type="hidden"
                               value="{{ count($detailProduct->productImage) > 0 ? asset($detailProduct->productImage[0]->image_path) : 'images/product/product_demo_2.png' }}"
                               name="image"/>
                        <div class="quantity">
                            <input type="number" name="qty" value="1">
                        </div>
                        <div class="addcart col-9">
                            <a href="/lien-he" target="_blank">
                                <button type="button" class="btn btn_add_cart btn-cart add_to_cart">
                                    LIÊN HỆ
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="compare-product">
                        <div class="div-btn-compare">
                            <button type="button" class="btn btn-compare w-100">
                                <a href="/so-sanh-san-pham?product[]={{$detailProduct->id}}">
                                    + SO SÁNH
                                </a>
                            </button>
                        </div>
                        <div class="div-btn-tag">
                            <button type="button" class="btn btn-tag w-100">
                                <img src="{{ asset('images/tag.png') }}" alt="tag">
                            </button>
                        </div>
                        <div class="div-btn-print">
                            <button type="button" class="btn btn-print w-100" onclick="window.print()">
                                <img src="{{ asset('images/printer.png') }}" alt="tag">
                            </button>
                        </div>
                        <div class="div-btn-share">
                            <button type="button" class="btn btn-share w-100">
                                <?php
                                $url = config('app.url') . '/chi-tiet-san-pham/';
                                ?>
                                <a
                                    onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{$url.$detailProduct->id}}', 'newwindow',
                                       'width=300,height=250');  return false;"
                                >
                                    <img src="{{ asset('images/share.png') }}" alt="tag">
                                </a>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="product-description">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @if (!empty($detailProduct->description))
                    @foreach ($detailProduct->description as $key => $dec)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne-{{ $key }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne-{{ $key }}" aria-expanded="false"
                                        aria-controls="flush-collapseOne-{{ $key }}">
                                    {{ $dec['title'] }}
                                </button>
                            </h2>
                            <div id="flush-collapseOne-{{ $key }}" class="accordion-collapse collapse"
                                 aria-labelledby="flush-headingOne-{{ $key }}"
                                 data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <?php echo nl2br($dec['content']); ?>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Không có mô tả sản phẩm</p>
                @endif
            </div>
        </div>
        @if (!empty($aryRelatedProd))
            @include('partials.related-product', ['aryRelatedProd' => $aryRelatedProd])
        @endif

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
                                    <text>{{ $aryComments->total() }} đánh giá</text>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="review-2">
                    <h6>
                        @if($aryComments->total() > 0)
                            {{ ($aryComments->total()) - $countCommentNotRating }} trong số {{ $aryComments->total() }}
                            ({{ ceil(( ($aryComments->total()) - $countCommentNotRating) * 100 / $aryComments->total()) }}
                            %) người đánh giá giới thiệu sản phẩm này
                        @else
                            0 trong số 0% người đánh giá giới thiệu sản phẩm này
                        @endif
                    </h6>
                </div>
            </div>
            <div class="review-content-2">
                <div class="content-btn">
                    <input type="text" name="search_review" id="search-review" placeholder="Tìm kiếm nhận xét">
                    <button type="button" class="btn-search-review">
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
                    @for ($i = 0; $i < 5; $i++)
                        @php
                            $totalStar = 0;
                                foreach ($aryCountStar as $key => $star) {
                                    if ($star['rating'] == $i + 1) {
                                        $totalStar = $star['count_star'];
                                    }
                                }
                        @endphp
                        <div class="review-item">
                            <p>{{ $i + 1 }}★</p>
                            <div class="review-scale">
                                <button style="margin: 0; padding: 0; border: none; outline: none;">
                                    <div class="scale-100" style="position: relative; width: 300px; height: 10px;">
                                        <div class="scale-percent"
                                             style="
                                         position: absolute;
                                         width: {{( $totalStar /10) * 100}}%;
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
                                    {{ $totalStar }}
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="write-cmt col-md-3 col-12">
                <button class="write btn-review" type="button" data-bs-toggle="modal" data-bs-target="#reviewmodal">
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
                                        <span class="rate-star-product">
                                            @for ($i = 1; $i < 6; $i++)
                                                <i class="rating__icon rating__icon--star fa fa-star"
                                                   style="color: {{ $averageStar < $i ? '#DBDBDB' : '#ED2027' }}; "></i>
                                            @endfor
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="quality">
                            <h6>Chất lượng</h6>
                            <div class="point-group">
                                <div class="point-item">
                                    @for ($i = 1; $i < 6; $i++)
                                        <div
                                            class="point {{ $averageQuality < $i ? 'point-unactive' : 'point-active' }}"></div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="value">
                            <h6>Giá trị</h6>
                            <div class="point-group">
                                <div class="point-item">
                                    @for ($i = 1; $i < 6; $i++)
                                        <div
                                            class="point {{ $averageWorth < $i ? 'point-unactive' : 'point-active' }}"></div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (!empty($aryComments))
            @include('partials.comment-product', ['comments' => $aryComments, 'product_id' => $detailProduct->id])
        @endif

        @if (!empty($productList))
            @include('partials.recently-viewed-product', ['aryRecentProd' => $productList])
        @endif
        @include('partials.modals.review-modal', ['product_id' => $detailProduct->id])
    </div>
@endsection

@push('scripts')
    <script>
        $('#form_testimonial').on('submit', function (e) {
            e.preventDefault()
            var formdata = new FormData($(this)[0]);
            insertdata(formdata)
        })

        function resetFormTestimonial() {
            $('#form_testimonial textarea[name="body"]').val('')
            $('#form_testimonial input[name="full_name"]').val('')
            $('#form_testimonial input[name="phone_number"]').val('')
            $('#form_testimonial input[name="email"]').val('')
            $('#form_testimonial input[name="address"]').val('')
            $('.count-text-body-review').text('0')
            $('#image_review_render').html('')
        }

        function insertdata(formdata) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route('submitRatingComment')}}',
                data: formdata,
                dataType: 'json',
                type: 'post',
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.success == 1) {
                        toastr.success('Thành công', 'Đánh giá của bạn sẽ được hệ thống kiểm duyệt. Xin cám ơn.')
                        $('#reviewmodal').modal('hide');
                        setTimeout(() => {
                            location.reload();
                        }, 2500);
                        resetFormTestimonial()
                    }
                },
                error: function (err) {
                    //$('#btn-review').prop('disabled', true)
                    if (err.status == 422) {
                        if ('phone_number' in err.responseJSON.errors) {
                            $('#phone_number_div_alert').text(err.responseJSON.errors.phone_number[0])
                        } else {
                            $('#phone_number_div_alert').text('')
                        }
                        if ('address' in err.responseJSON.errors) {
                            $('#address_div_alert').text(err.responseJSON.errors.address[0])
                        } else {
                            $('#address_div_alert').text('')
                        }
                        if ('title' in err.responseJSON.errors) {
                            $('#title_div_alert').text(err.responseJSON.errors.title[0])
                        } else {
                            $('#title_div_alert').text('')
                        }
                        if ('email' in err.responseJSON.errors) {
                            $('#email_div_alert').text(err.responseJSON.errors.email[0])
                        } else {
                            $('#email_div_alert').text('')
                        }
                        if ('body' in err.responseJSON.errors) {
                            $('#body_div_alert').text(err.responseJSON.errors.body[0])
                        } else {
                            $('#body_div_alert').text('')
                        }
                        if ('full_name' in err.responseJSON.errors) {
                            $('#full_name_div_alert').text(err.responseJSON.errors.full_name[0])
                        } else {
                            $('#full_name_div_alert').text('')
                        }
                    }
                }
            })
        }
    </script>
    <script>
        $('.btn-search-review').on('click', function () {
            var keyword = $('#search-review').val();
            $.ajax({
                url: '{{ route('findComment') }}',
                type: 'GET',
                data: {
                    search_review: keyword,
                },
                //Ajax events
                success: function (response) {
                    var star = '';
                    for (let i = 1; i < 6; i++) {
                        star += `<i class="fa fa-star" style="color: ${response.data.rating < i ? '#DBDBDB' : '#ED2027'}; "></i>`
                    }

                    var quality = '';
                    for (let q = 1; q < 6; q++) {
                        quality += `<i class="point ${response.data.count_quality < q ? 'point-unactive' : 'point-active'} "></i>`
                    }

                    var worth = '';
                    for (let w = 1; w < 6; w++) {
                        worth += `<i class="point ${response.data.count_worth < w ? 'point-unactive' : 'point-active'} "></i>`
                    }

                    var img = ''
                    if (response.data.file.length > 0) {
                        $.each(response.data.file, function (index, value) {
                            img += `<div class="col-3">
                                        <img src="${value}" >
                                    </div>`
                        });
                    }
                    var html = `<div class="review-item row" id="comment-id-${response.data.id}">
                                    <div class="customer-info col-sm-3 col-12">
                                        <div class="name">${response.data.user.name}</div>
                                        <div class="address">${response.data.user.address}</div>
                                        <div class="comment">Bình luận: 1</div>
                                        <div class="has-review">Đã đánh giá: 61</div>
                                        <div class="gender">Giới tính: ${response.data.user.gender == 0 ? `Nam` : `Nữ`}</div>
                                        <div class="age">Tuổi: 35-44</div>
                                    </div>
                                    <div class="review-content col-sm-6 col-12">
                                        <div class="rating-star">
                                            ${star}
                                            <i class="fa fa-circle" style="font-size: 4px; padding: 0 10px; color: #444444;"></i>
                                            <div class="dot">
                                                <h6 class="timer">15 phút trước</h6>
                                            </div>
                                        </div>
                                        <div class="review-title">
                                            <h6>${response.data.title}</h6>
                                        </div>
                                        <div class="review-main-content">
                                            <div class="content-1">
                                                ${response.data.body}
                                            </div>
                                            <div class="content-2">
                                                <div class="review-useful">
                                                    <h6>Đánh giá sản phẩm này
                                                        <text>✔ Hữu ích</text>
                                                    </h6>
                                                </div>
                                                <div class="review-image row">
                                                    ${img}
                                                </div>
                                                <div class="make-review-useful">
                                                    <h6>Hữu ích ?</h6>
                                                    <button class="useful">
                                                        Có
                                                        <i class="fa fa-circle"
                                                        style="font-size: 4px; padding: 0 4px; color: #444444;"></i>
                                                        <text>${response.data.count_like}</text>
                                                    </button>
                                                    <button class="unuseful">
                                                        Không
                                                        <i class="fa fa-circle"
                                                        style="font-size: 4px; padding: 0 4px; color: #444444;"></i>
                                                        <text>${response.data.count_dislike}</text>
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
                                                        ${quality}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="value">
                                                <h6>Giá trị</h6>
                                                <div class="point-group">
                                                    <div class="point-item">
                                                        ${worth}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                    $('.review-detail-content').append(html);

                    $('html, body').animate({
                        scrollTop: $("#comment-id-" + response.data.id).offset().top
                    }, 2000);
                }
            })
        });
    </script>
@endpush


