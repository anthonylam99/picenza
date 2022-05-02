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
                        <th>Thông tin người đặt hàng</th>
                        <th>Note</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo đơn</th>
                        <th>Chi tiết</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($aryOrder as $value)
                    @php
                        switch ($value['payment_status']) {
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
                        <tr>
                            <td>{{$value['id']}}</td>
                            <td>
                                <h6><b>Name: </b>{{ $value['user']['name'] }}</h6>
                                <h6><b>Email: </b>{{ $value['user']['email'] }}</h6>
                                <h6><b>Phone: </b>{{ $value['user']['phone'] }}</h6>
                                <h6><b>Địa chỉ: </b>{{ $value['address'] . ', ' . get_name_district($value['district_id']) . ', ' . get_name_province($value['province_id'])  }}</h6>
                            </td>
                            <td>{{ $value['note'] }}</td>
                            <td>{{ $value['total_price'] }}₫</td>
                            <td>{{ $label }}</td>
                            <td>{{ date('d-m-Y', strtotime($value['created_at'])) }}</td>
                            <td>
                                <button class="btn btn-info">
                                    <a style="color: #FFFFFF" href="{{ route('admin.order.edit', $value['id']) }}">
                                        <i class="far fa-edit"></i>Chi tiết đơn hàng
                                    </a>
                                </button>
                            </td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
