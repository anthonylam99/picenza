@extends('admin.index')

@section('pageTitle', 'Trang sản phẩm')

@section('breadcrumbContent')
<li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
<li class="breadcrumb-item active">Danh sách sản phẩm</li>
@endsection

@section('content')
<div class="col-12">
    <div class="panel-container show card p-3">
        <div class="panel-content">
            <div class="col-sm-12 row">
                @php
                    switch ($order->payment_status) {
                        case 0:
                            $label = 'Chưa thanh toán';
                            break;

                        case 1:
                            $label = 'Đã thanh toán';
                            break;

                        case 2:
                            $label = 'Đã hủy';
                            break;
                        default:
                            $label = 'Chưa thanh toán';
                            break;
                    }
                @endphp
                <h1 class="display-4 mb-3 col-sm-12">
                    Trạng thái đơn hàng:
                    <span class="text-info">{{ $label }}</span>
                </h1>
                <div class="col-sm-6 card p-3 pr-3">
                    <div id="panel-1" class="panel">
                        <div class="panel-hdr">
                            <h2>
                                Thông tin khách hàng
                            </h2>
                        </div>
                        <div class="panel-container show">
                            <div class="panel-content">
                                <p><strong>Họ tên: </strong>{{ $order->user->name }}</p>
                                <hr>
                                <p><strong>Email: </strong>{{ $order->user->email }}</p>
                                <hr>
                                <p><strong>Phone: </strong>{{ $order->user->phone }}</p>
                                <hr>
                                <p><strong>Địa chỉ: </strong>{{ $order->address . ', ' . get_name_district($order->district_id) . ', ' . get_name_province($order->province_id)  }}</p>
                                <hr>
                                <p><strong>Ghi chú:</strong>{{ $order->note }}</p>
                                <p></p>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 card p-3 pr-3">
                    <div id="panel-1" class="panel">
                        <div class="panel-hdr">
                            <h2>
                                Thông tin sản phẩm
                            </h2>
                        </div>
                        <div class="panel-container show">
                            <div class="panel-content">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px;text-align: center">#</th>
                                            <th style="width: 80px;text-align: center">Ảnh</th>
                                            <th style="text-align: center">Tên sản phẩm</th>
                                            <th style="width: 50px;text-align: center">SL</th>
                                            <th style="width: 120px;text-align: center">Giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($aryProd as $prod)
                                        <tr>
                                            <th scope="row">{{ $prod['id'] }}</th>
                                            <td><img class="img-fluid" src="{{ asset($prod['image_path']) }}"></td>
                                            <td>
                                                <p>{{ $prod['product']['name'] }}</p>
                                            </td>
                                            <td style="text-align: center">{{ $prod['qty'] }}</td>
                                            <td style="color: #ff0000;text-align: right">@money($prod['price'] * $prod['qty'])</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4" style="text-align: right">Tổng tiền: </td>
                                            <td style="color: #ff0000;text-align: right">{{ $order['total_price'] }}₫</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($order->payment_status == 0)
                <div class="col-sm-12" style="padding: 20px 0 0 0">
                    <button type="button" onclick="changeStatusOrderAjax('{{ $order->id }}', 1)"
                        class="btn btn-success waves-effect waves-themed">Xác nhận đã xử lý</button>
                    <button type="button" onclick="changeStatusOrderAjax('{{ $order->id }}', 2)"
                        class="btn btn-danger waves-effect waves-themed">Hủy đơn hàng</button>
                </div>
                @endif
            </div>
            <script>
                function changeStatusOrderAjax(id,type){
                    $.ajax({
                        type:'GET',
                        url:'{{ route('admin.order.update') }}',
                        data:{
                            id:id,
                            type:type
                        },
                        beforeSend:function(){

                        },
                        success:function(rest){
                            alert(rest.message);
                            location.reload();
                        }
                    });
            }
            </script>
        </div>
    </div>
</div>
@endsection

