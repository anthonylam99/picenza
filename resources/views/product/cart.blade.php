@extends('main')

@section('title', 'Giỏ hàng')
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
<section id="body_w">
    <!-- Star Content Website -->
    <section class="clearfix wrapped_content">
        <a href="{{ URL::previous() }}" class="btn_back_order"><i class="fa fa-arrow-left" aria-hidden="true"></i> Tiếp
            tục xem sản phẩm</a>
        <div class="clearfix content_order">
            <form action="{{ route('saveOrder') }}" method="POST">
                @csrf
                <div class="clearfix top_order">
                    <ul class="listorder">
                        @forelse (Cart::content() as $item)
                        <li class="justadded">
                            <div class="colimg">
                                <a href="javascript:;">
                                    <img width="55" src="{{ $item->options->image }}">
                                </a>
                                <button type="button" class="delete destroy-cart"
                                    onclick="destroyItem('{{ $item->rowId }}')"><span></span>Xóa</button>
                            </div>
                            <div class="colinfo">
                                <strong>@money($item->price)</strong>
                                <a href="javascript:;">{{ $item->name }}</a>
                                @php
                                    $getColor = get_color_from_id($item->options->color);
                                @endphp
                                <span>Màu: {{ $getColor->color }}</span>
                                <div class="choosenumber">
                                    <div class="abate btnMinus" data-row="{{ $item->rowId }}"></div>
                                    <div class="number">{{ $item->qty }}</div>
                                    <div class="augment btnPlus" data-row="{{ $item->rowId }}"></div>
                                </div>
                                <div class="clr"></div>
                            </div>
                        </li>
                        <input type="hidden" name="item[id][]" value="{{ $item->id }}">
                        <input type="hidden" name="item[color][]" value="{{ $item->options->color }}">
                        <input type="hidden" name="total_price" value="{{ Cart::subtotal() }}">
                        <input type="hidden" name="qty" value="{{ $item->qty }}">
                        @empty
                        <span class="text-center">Không có sản phẩm nào trong giỏ hàng</span>
                        @endforelse
                    </ul>
                    <div class="area_total">
                        <div>
                            <div class="price-one">
                                <span>Tổng tiền:</span>
                                <span>{{ Cart::subtotal() }}₫</span>
                            </div>
                            <div id="coupon_view" class="none">
                                <span>Coupon: <strong style="text-transform: uppercase"></strong></span>
                                <span class=""></span>
                            </div>
                            <div class="shipping_home">

                                <div class="total">
                                    <b>Cần thanh toán:</b>
                                    <strong>{{ Cart::subtotal() }}₫</strong>
                                </div>
                            </div>
                        </div>
                        <div class="boxCouponCode" style="">
                            <div class="textcode">
                                Sử dụng mã giảm giá
                            </div>
                            <div class="inputcode " style="display:none;">
                                <button type="button" onclick="addCoupon()">Áp dụng</button>
                                <input name="CouponCode" id="CouponCode" placeholder="Nhập mã giảm giá" maxlength="20">
                                <label id="CouponCode-error" class="error" for="CouponCode"
                                    style="display: none;"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix box_info">
                    <p>Nhập đầy đủ thông tin bên dưới</p>
                    <input type="hidden" value="1" name="sl">
                    <div class="clearfix box-form col-6-cus">

                        <input type="text" placeholder="Họ và tên" class="required" name="user_name">
                    </div>
                    <div class="clearfix box-form col-6-cus">

                        <input type="text" class="required"  placeholder="Số điện thoại" name="phone">
                    </div>
                    <div class="clearfix box-form" style="margin-top: 10px">

                        <input type="email" placeholder="Email" class="required" name="email" value="">
                    </div>
                    <div class="clearfix box-form" style="margin-top: 10px">

                        <input type="text" placeholder="Yêu cầu khác (Không bắt buộc)" class="" name="note" value="">
                    </div>
                    <p class="clearfix"></p>
                    <div class="inputGroup">
                        <input id="pay_cod" name="type_pay" value="1" type="radio" checked="">
                        <label for="pay_cod" onclick="checkTypePayment(1)">Thanh toán khi nhận hàng</label>
                    </div>
                    <div class="area_other" style="display: block">
                        <div class="textnote"><b>Để được phục vụ nhanh hơn,</b> hãy chọn thêm:</div>
                        <div class="address title_order_box">
                            <label class="choose"><i class="iconmobile-opt"></i>&nbsp;Địa chỉ giao hàng</label>
                        </div>
                        @php
                        $provinceId = old('address.province') ? old('address.province'):'';
                        $districtId = old('address.district') ? old('address.district'):'';
                        @endphp
                        <div class="area_address bg_box_order" style="display: block">
                            <div class="firstaddress ">
                                <div class="citydis">
                                    <div class="city">
                                        <select id="province_id" name="address[province]" class="form-control">
                                            @include('partials.province',['provinceId'=>$provinceId])

                                        </select>
                                    </div>
                                    <div class="dist">
                                        <select id="district_id" name="address[district]" class="form-control">
                                            @include('partials.district',['provinceId'=>$provinceId,'districtId'=>$districtId])
                                        </select>
                                    </div>
                                </div>
                                <div class="box-form" style="float: none"><input type="text"
                                        placeholder="Số nhà, tên đường, phường / xã" id="customerAddress"
                                        name="address" class="homenumber" value=""></div>
                            </div>
                        </div>
                        <div class="area_market bg_box_order">

                        </div>
                    </div>
                    <input type="hidden" class="input_province_id" name="province_id">
                    <input type="hidden" class="input_district_id" name="district_id">
                    <p class="clearfix"></p>
                    <div class="choosepayment">
                        <button type="submit" class="payoffline">Thanh toán khi nhận hàng</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- End Content Website -->
</section>
<script>
    function destroyItem(rowId) {
        $.ajax({
            url: '{{ route('removeItemCart') }}',
            type: 'GET',
            data: {
                rowId: rowId,
            },
            //Ajax events
            success: function (response) {
                location.reload();
            }
        })
    }
</script>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        var district ='';
        var province ='';
        var ward ='';
        $('#province_id').change(function() {
            $('.input_province_id').val($(this).val());
            $.ajax({
                url: "{{ route('locations.district') }}",
                type: 'GET',
                data: {'province_id': $(this).val()},
                cache: false,
                success: function(data){
                    $('#district_id').html(data);
                }
            });
             province = $(this).find('option:selected').text();
            
        });

        $('#district_id').change(function() {
            $('.input_district_id').val($(this).val());
            $.ajax({
                url: "{{ route('locations.ward') }}",
                type: 'GET',
                data: {'district_id': $(this).val()},
                cache: false,
                success: function(data){
                    $('#ward_id').html(data);
                }
            });
            district = $(this).find('option:selected').text();
            
        });
        $('#ward_id').change(function() {
            ward = $(this).find('option:selected').text();
            $('.address').val(ward +','+ district +','+province);
        });

        // Substract qty cart
        var qty = $("input[name=qty]").val();
        $('.btnMinus').click(function(){
            var rowId = $(this).data('row');
            if (qty == 1) {
                alert('Sản phẩm đã đặt ở số lượng tối thiểu');
                return;
            }
            qty = qty - 1;
            updateQty(rowId, qty);
        })

        $('.btnPlus').click(function(){
            var rowId = $(this).data('row');
            qty = (+qty) + 1;
            updateQty(rowId, qty);
        })

        function updateQty(rowId, newQty) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('updateQtyCart') }}",
                type: 'POST',
                data: {
                    rowId: rowId,
                    qty: newQty
                },
                success: function(response){
                    location.reload();
                }
            });
        }
    });
</script>
@endpush