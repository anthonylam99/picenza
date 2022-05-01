@extends('main')

@section('title', 'Danh mục sản phẩm')
@section('font-awsomes' ,'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')

@section('breadcrumb')
    <div class="breadcrumb-s">
        <div class="breadcrumb-s-content container middle">
            <div class="breadcrumb-content middle">
                <img width="10" height="10" src="{{ asset('images/arrow-right.png') }}" alt="tag">
                <a href="">Danh mục {{ $categoryName }}</a>
            </div>
            <div class="breadcrumb-path">
                <ul class="middle">
                    <li>
                        <a href="">Trang chủ</a> /&nbsp;
                    </li>
                    <li>
                        <a href="">Danh mục {{$categoryName}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <form action="" action="GET">
        <div class="category">
            <div class="content-category container">
                <div class="content-1 row">
                    <div class="filter col-3">
                        <div class="content-filter">
                            <div class="title">
                                <div class="title-1">
                                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.1683 13.6788C8.29294 13.6179 8.39799 13.5234 8.47155 13.4061C8.54511 13.2888 8.58425 13.1533 8.58455 13.015V9.02501C8.58455 8.82851 8.66358 8.63951 8.80509 8.50001L13.4124 3.95951C13.6946 3.68126 13.8534 3.30326 13.8534 2.90951V0.992514C13.853 0.894486 13.8332 0.797499 13.7952 0.707102C13.7571 0.616706 13.7015 0.534677 13.6316 0.46571C13.5617 0.396742 13.4788 0.342191 13.3877 0.305179C13.2966 0.268167 13.1991 0.249421 13.1007 0.250014H1.05757C0.641327 0.250014 0.304871 0.581514 0.304871 0.992514V2.90951C0.304871 3.30326 0.46369 3.68126 0.745952 3.95951L5.35321 8.50001C5.42302 8.56862 5.47846 8.65036 5.51632 8.74048C5.55418 8.8306 5.5737 8.92731 5.57376 9.02501V13.7575C5.57376 14.3088 6.16236 14.6673 6.66291 14.4205L8.1683 13.6788Z"
                                            fill="white"/>
                                    </svg>
                                    <h6>BỘ LỌC</h6>
                                </div>
                                <div class="clear-btn">
                                    <button>
                                        <a href="{{request()->url()}}">Clear</a>
                                    </button>
                                </div>
                            </div>
                            <div class="content-main-filter">
                                <input type="hidden" name="category_id" value="1">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#price"
                                                    aria-expanded="false" aria-controls="price">
                                                PHẠM VI GIÁ
                                            </button>
                                        </h2>
                                        <div id="price" class="accordion-collapse collapse"
                                             aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                @foreach($productPrice as $value)
                                                    <input id="price{{$value->id}}" type="checkbox" name="price[]"
                                                           value="{{$value->id}}"
                                                           onChange="this.form.submit()" {{ is_array(request()->input('price')) && in_array($value->id, request()->input('price')) ? 'checked' : ''}}>
                                                    <label for="price{{$value->id}}">
                                                        {{$value->name}}&nbsp;</label><br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#company"
                                                    aria-expanded="false" aria-controls="company">
                                                HÃNG SẢN XUẤT
                                            </button>
                                        </h2>
                                        <div id="company" class="accordion-collapse collapse"
                                             aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                @foreach($company as $value)
                                                    <input id="company{{$value->id}}" type="checkbox" name="company[]"
                                                           value="{{$value->id}}"
                                                           onChange="this.form.submit()" {{ is_array(request()->input('company')) && in_array($value->id, request()->input('company')) ? 'checked' : ''}}>
                                                    <label for="company{{$value->id}}">
                                                        {{$value->name}}&nbsp;</label><br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @foreach($featureData as $featureItem)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#customFeature{{$featureItem->id}}"
                                                        aria-expanded="false"
                                                        aria-controls="customFeature{{$featureItem->id}}">
                                                    {{$featureItem->name}}
                                                </button>
                                            </h2>
                                            <div id="customFeature{{$featureItem->id}}"
                                                 class="accordion-collapse collapse"
                                                 aria-labelledby="flush-headingOne"
                                                 data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    @foreach($featureItem->sub as $value)
                                                        <input id="feature{{$value->id}}" type="checkbox"
                                                               name="feature[]" value="{{$value->id}}"
                                                               onChange="this.form.submit()" {{ is_array(request()->input('feature')) && in_array($value->id, request()->input('feature')) ? 'checked' : ''}}>
                                                        <label for="feature{{$value->id}}">
                                                            {{$value->name}}&nbsp;</label><br>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product col-9">
                        <div class="content-product">
                            <div class="title">
                                <div class="title-1">
                                    <div class="sub-title">
                                        <h5 style="text-transform: uppercase">DANH MỤC {{$categoryName}}</h5>
                                        <p>{{count($product)}} sản phẩm</p>
                                    </div>
                                    <div class="order-title">
                                        <select name="orderBy" id="orderBy" onChange="this.form.submit()">
                                            <option value="1"
                                                     {{ request()->input('orderBy') == 1 ? 'selected' : ''}}>
                                                Sắp xếp theo: Liên quan nhất
                                            </option>
                                            <option value="2"
                                                     {{ request()->input('orderBy') == 2 ? 'selected' : ''}}>
                                                Sắp xếp theo: Mới nhất
                                            </option>
                                            <option value="3"
                                                    {{ request()->input('orderBy') == 3 ? 'selected' : ''}}>
                                                Sắp xếp theo: Giá từ cao đến thấp
                                            </option>
                                            <option value="4"
                                                     {{ request()->input('orderBy') == 4 ? 'selected' : ''}}>
                                                Sắp xếp theo: Giá từ thấp đến cao
                                            </option>
                                        </select>
                                        <div class="div-btn-print">
                                            <button class="btn-print">
                                                <img src="{{ asset('images/printer.png') }}" alt="tag">
                                            </button>
                                        </div>
                                        <div class="div-btn-share">
                                            <button class="btn-share">
                                                <img src="{{ asset('images/share.png') }}" alt="tag">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="main-content row">
                                @foreach($product as $value)
                                    <div class="product-main-item col-4">
                                        <div class="product-item">
                                            <a class="product-box"
                                               href="{{ route('product.detail', ['id' => $value->id]) }}">
                                                <div class="image">
                                                    <img src="{{$value->avatar_path}}" alt="">
                                                </div>
                                                <div class="description text-center">
                                                    <div class="name">
                                                        <h5>{{ $value->name }}</h5>
                                                    </div>
                                                    <div class="price">
                                                        <div class="sale">{{ number_format($value->sale_price) }}đ</div>
                                                        <div class="unsale">{{number_format($value->price)}}đ</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
