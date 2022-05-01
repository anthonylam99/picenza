@extends('admin.index')

@section('pageTitle', 'Trang sản phẩm')

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
    <li class="breadcrumb-item active">Danh sách sản phẩm</li>
@endsection

@section('content')
    <div class="col-3">
        <button style="margin-bottom: 10px" type="button" class="btn btn-success">
            <a style="color: #FFFFFF;" href="{{route('admin.product.add')}}">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Thêm mới
            </a>
        </button>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title" style="font-size: 20px; font-weight: 500">DANH SÁCH SẢN PHẨM</h2>

                <div class="form-search float-right">
                    <form style="margin-bottom: 0" class="form-group" action="{{route('admin.product.list')}}">
                        <input  class="form-control" type="text" name="s" value="" placeholder="Tìm kiếm sản phẩm....">
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-bordered table-striped table-bordered bulk_action">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Sản phẩm</th>
                        <th>Thông tin người đặt hàng</th>
                        <th>Note</th>
                        <th>Địa chỉ</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($aryOrder as $value)
                        <tr>
                            <td>{{$value['id']}}</td>
                            <td>
                                @foreach ($value['info-product'] as $prod)
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ asset($prod['image_path']) }}" alt="">
                                    </div>
                                    <div class="col-md-7">
                                        <h5>{{ $prod['product']['name'] }}</h5>
                                        <p>Màu: {{ $prod['color']['color'] }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </td>
                            <td>
                                <h6>{{ $value['user']['name'] }}</h6>
                                <h6>{{ $value['user']['email'] }}</h6>
                                <h6>{{ $value['user']['phone'] }}</h6>
                            </td>
                            <td>{{ $value['note'] }}</td>
                            <td>
                                {{ $value['address'] . ', ' . get_name_district($value['district_id']) . ', ' . get_name_province($value['province_id'])  }}
                            </td>
                            <td>{{ $value['total_price'] }}</td>
                            <td>{{ $value['payment_status'] == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}</td>
                            
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
