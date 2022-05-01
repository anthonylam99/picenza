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
            <a href="">{{ $detailProduct->name }}</a>
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
<section id="body_w">
    <!-- Star Content Website -->
    <section class="clearfix wrapped_content">
        <a href="https://sheshines.vn/chi-tiet/cap-goi-xa.html" class="btn_back_order"><i class="fa fa-arrow-left"
                aria-hidden="true"></i> Tiếp tục xem sản phẩm</a>
        <div class="clearfix content_order">
            <div class="clearfix top_order">
                <ul class="listorder">
                    <li class="justadded">
                        <div class="colimg">
                            <a href="javascript:;">
                                <img width="55" src="/public/uploads/2022/03/fbdea5777ea78bf9d2b6-x80.jpg">
                            </a>
                            <button type="button" onclick="removeItemsCar(0)" class="delete"><span></span>Xóa</button>
                        </div>
                        <div class="colinfo">
                            <strong>510.000 ₫</strong>
                            <a href="javascript:;">Cặp Dầu Gội - Kem Xả Lotus Sheshines</a>
                            <div class="choosenumber">
                                <div class="abate" onclick="btnMinus(0)"></div>
                                <div class="number">1</div>
                                <div class="augment " onclick="btnPlus(0)"></div>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </li>
                </ul>
                <div class="area_total">
                    <div>
                        <div class="price-one" data-price="510000">
                            <span>Tổng tiền:</span>
                            <span>510.000 ₫</span>
                        </div>
                        <div id="coupon_view" class="none">
                            <span>Coupon: <strong style="text-transform: uppercase"></strong></span>
                            <span class=""></span>
                        </div>




                        <div class="shipping_home">

                            <div class="total" data-value="510000">
                                <b>Cần thanh toán:</b>
                                <strong>510.000 ₫</strong>
                            </div>
                        </div>
                        <div class="shipping_store none" style="display: none;">

                            <div class="total" data-value="4690000">
                                <b>Cần thanh toán:</b>
                                <strong>4.690.000₫</strong>
                                <input data-val="true" data-val-number="The field TotalMoneyAll must be a number."
                                    data-val-required="The TotalMoneyAll field is required." id="TotalMoneyAll"
                                    name="TotalMoneyAll" type="hidden" value="4990000">
                                <input id="TotalMoneyPay" name="TotalMoneyPay" type="hidden" value="4690000">
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
                            <label id="CouponCode-error" class="error" for="CouponCode" style="display: none;"></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix box_info">
                <p>Nhập đầy đủ thông tin bên dưới</p>
                <form method="POST" onsubmit="return validateForm();" action="https://sheshines.vn/dat-mua-san-pham"
                    id="form_order">
                    <input type="hidden" name="_token" value="hHgl7xOutfA6wMiQh3HVHXNejT7XWU4lEs3hjA3J">
                    <input type="hidden" value="1" name="sl">
                    <div class="clearfix box-form col-6-cus">

                        <input type="text" placeholder="Họ và tên" class="required" value="" name="name">
                    </div>
                    <div class="clearfix box-form col-6-cus">

                        <input type="text" class="required" onkeyup="checkInputNumberOnly(this)" value=""
                            placeholder="Số điện thoại" name="phone">
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
                        <input type="hidden" name="order_to" id="order_to" value="1">
                        <div class="area_address bg_box_order" style="display: block">
                            <div class="firstaddress ">
                                <div class="citydis">
                                    <div class="city">
                                        <select id="cityId" name="" class="form-control">
                                            <option value="">Chọn Tỉnh/ thành phố</option>
                                            <option value="254">Hà Nội</option>
                                            <option value="255">Hồ Chí Minh</option>
                                            <option value="256">An Giang</option>
                                            <option value="257">Bà Rịa - Vũng Tàu</option>
                                            <option value="258">Bắc Ninh</option>
                                            <option value="259">Bắc Giang</option>
                                            <option value="260">Bình Dương</option>
                                            <option value="261">Bình Định</option>
                                            <option value="262">Bình Phước</option>
                                            <option value="263">Bình Thuận</option>
                                            <option value="264">Bến Tre</option>
                                            <option value="265">Bắc Cạn</option>
                                            <option value="266">Cần Thơ</option>
                                            <option value="267">Khánh Hòa</option>
                                            <option value="268">Thừa Thiên Huế</option>
                                            <option value="269">Lào Cai</option>
                                            <option value="270">Quảng Ninh</option>
                                            <option value="271">Đồng Nai</option>
                                            <option value="272">Nam Định</option>
                                            <option value="273">Cà Mau</option>
                                            <option value="274">Cao Bằng</option>
                                            <option value="275">Gia Lai</option>
                                            <option value="276">Hà Giang</option>
                                            <option value="277">Hà Nam</option>
                                            <option value="278">Hà Tĩnh</option>
                                            <option value="279">Hải Dương</option>
                                            <option value="280">Hải Phòng</option>
                                            <option value="281">Hoà Bình</option>
                                            <option value="282">Hưng Yên</option>
                                            <option value="283">Kiên Giang</option>
                                            <option value="284">Kon Tum</option>
                                            <option value="285">Lai Châu</option>
                                            <option value="286">Lâm Đồng</option>
                                            <option value="287">Lạng Sơn</option>
                                            <option value="288">Long An</option>
                                            <option value="289">Nghệ An</option>
                                            <option value="290">Ninh Bình</option>
                                            <option value="291">Ninh Thuận</option>
                                            <option value="292">Phú Thọ</option>
                                            <option value="293">Phú Yên</option>
                                            <option value="294">Quảng Bình</option>
                                            <option value="295">Quảng Nam</option>
                                            <option value="296">Quảng Ngãi</option>
                                            <option value="297">Quảng Trị</option>
                                            <option value="298">Sóc Trăng</option>
                                            <option value="299">Sơn La</option>
                                            <option value="300">Tây Ninh</option>
                                            <option value="301">Thái Bình</option>
                                            <option value="302">Thái Nguyên</option>
                                            <option value="303">Thanh Hoá</option>
                                            <option value="304">Tiền Giang</option>
                                            <option value="305">Trà Vinh</option>
                                            <option value="306">Tuyên Quang</option>
                                            <option value="307">Vĩnh Long</option>
                                            <option value="308">Vĩnh Phúc</option>
                                            <option value="309">Yên Bái</option>
                                            <option value="310">Đắc Lắc</option>
                                            <option value="311">Đồng Tháp</option>
                                            <option value="312">Đà Nẵng</option>
                                            <option value="313">Đắc Nông</option>
                                            <option value="314">Hậu Giang</option>
                                            <option value="315">Bạc Liêu</option>
                                            <option value="316">Điện Biên</option>
                                        </select>
                                    </div>
                                    <div class="dist">
                                        <select id="districtId" name="" class="form-control">
                                            <option value="">Chọn Quận/ Huyện</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="district" value="" id="district">
                                <div class="box-form" style="float: none"><input type="text"
                                        placeholder="Số nhà, tên đường, phường / xã" id="customerAddress"
                                        name="customerAddress" maxlength="200" class="homenumber" value=""></div>
                            </div>
                        </div>
                        <div class="area_market bg_box_order">

                        </div>
                    </div>
                    <p class="clearfix"></p>
                    <div class="choosepayment">
                        <button type="submit" class="payoffline">Thanh toán khi nhận hàng<span>Xem hàng trước, không mua
                                không sao</span></button>
                        <div class="payonline dis_btn">
                            <div>
                                Thanh toán online<span>Bằng thẻ ATM, Visa, Master</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End Content Website -->
</section>
@endsection