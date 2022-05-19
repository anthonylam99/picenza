@extends('main')

@section('title', 'So sánh sản phẩm')
@section('font-awsomes' ,'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')
@section('style')
    <link href="{{ asset('css/order.css') }}" rel="stylesheet">
@endsection
@section('scripts')
    <script src="{{asset('js/owl.carousel.js')}}"></script>
@endsection

@section('breadcrumb')
    <div class="breadcrumb-s">
        <div class="breadcrumb-s-content container middle">
            {{-- <div class="breadcrumb-content middle">
                <img width="10" height="10" src="{{ asset('images/arrow-right.png') }}" alt="tag">
                <a href="">{{ $detailProduct->name }}</a>
            </div> --}}
            <div class="breadcrumb-path">
                <ul class="middle">
                    <li>
                        <a href="">Trang chủ</a> /&nbsp;
                    </li>
                    <li>
                        <a href="">So sánh sản phẩm </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="compare">
            <table class="table tab-content table-bordered table-striped table-compare">
                <tbody>
                <tr class="specs-group">
                    <th colspan="3">Thông tin chung</th>
                </tr>
                <tr class="specs equaHeight" data-obj="h3">
                    <td class="text " style="width:17.5%;">Hình ảnh, giá</td>
                    @foreach($product as $item)
                        <td class="item image" style="width:41.25%">
                            <p style="text-align:right;">
                                <?php
                                    $url = config('app.url').'/so-sanh-san-pham/';
                                    $arr = request()->input('product');
                                    if(is_array($arr) && in_array($item->id, $arr) ){
                                        if (($key = array_search($item->id, $arr)) !== false) {
                                            unset($arr[$key]);
                                        }
                                    }

                                    $param = '?';
                                    foreach($arr as $value){
                                        $param .= '&product[]='.$value;
                                    }
                                    $url = $url.$param;
                                ?>
                                <a href="{{ $url }}" class="remove" title="So sánh sản phẩm: ">
                                    <i class="fa fa-minus"></i>
                                </a>
                            </p>
                            <div class="image">
                                <a href="/chi-tiet-san-pham/{{$item->slug}}">
                                    <img style="width: 100% !important; height: 350px"
                                         src="{{(!empty($item->avatar_path) ? $item->avatar_path : asset('images/no-image.jpg'))}}">
                                </a>
                            </div>
                            <h3 style="height: 43.2px;">
                                <a href="/chi-tiet-san-pham/{{$item->slug}}">
                                    {{$item->name}}
                                </a>
                            </h3>
                            <div class="price-note">
                                <p class="price">
                                    <strong>{{number_format($item->sale_price)}} ₫ </strong>
                                    <i> <strike>{{number_format($item->price)}} ₫</strike></i>
                                    <i> | Giá đã bao gồm 10% VAT</i>
                                </p>
                                <p class="note"></p>
                            </div>
                        </td>
                    @endforeach
                    @if(count($product) <= 1)
                        <td class="item" style="width:41.25%">
                            <div class="add-product">
                                <h3 style="height: 43.2px;">Bạn muốn so sánh thêm sản phẩm?</h3>
                                <div class="input" style="position: relative">
                                    <input id="kwdCompare" type="text" placeholder="Tìm kiếm sản phẩm"
                                           autocomplete="off">
                                </div>
                            </div>
                        </td>
                    @endif
                </tr>
                <tr class="specs">
                    <th class="text">Mô tả</th>
                    @foreach($product as $item)
                        <td class="data">
                            <ugit
                            <li>
                                {{$item->short_desc}}
                            </li>
                            </ul>
                        </td>
                    @endforeach
                    @if(count($product) <= 1)
                        <td></td>
                    @endif
                </tr>
                <tr class="specs-group">
                    <th class="text" colspan="3">Tính năng</th>
                </tr>
                <tr class="specs">
                    <th class="text"</th>
                    @foreach($product as $item)
                        <td class="data">
                            <ul>
                                @if(isset($feature[$item->id]))
                                    @foreach($feature[$item->id] as $feature)
                                        <li>{{$feature->name}}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </td>
                    @endforeach
                    @if(count($product) <= 1)
                        <td></td>
                    @endif
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection

