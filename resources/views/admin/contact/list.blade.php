@extends('admin.index')

@section('pageTitle', 'Trang liên hệ')

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Liên hệ</a></li>
    <li class="breadcrumb-item active">Danh sách liên hệ</li>
@endsection

@section('content')
    <div class="col-3">
{{--        <button style="margin-bottom: 10px" type="button" class="btn btn-success">--}}
{{--            <a style="color: #FFFFFF;" href="{{route('admin.product.add')}}">--}}
{{--                <i class="fa fa-plus" aria-hidden="true"></i>--}}
{{--                Thêm mới--}}
{{--            </a>--}}
{{--        </button>--}}
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title" style="font-size: 20px; font-weight: 500">DANH SÁCH LIÊN HỆ</h2>

                <div class="form-search float-right">
                    <form style="margin-bottom: 0" class="form-group" action="{{route('admin.contact.list')}}">
                        <input  class="form-control" type="text" name="s" value="" placeholder="Tìm kiếm liên hệ....">
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-bordered table-striped table-bordered bulk_action">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Họ và tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Nội dung liên hệ</th>
                        <th>Ngày tạo đơn</th>
                        <th>Chi tiết</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($aryContact as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>
                                {{ $value->name }}
                            </td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->phone }}</td>
                            <td>{{ $value->feedback }}</td>
                            <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                            <td>
                                <button class="btn btn-info">
                                    <a style="color: #FFFFFF" href="{{ route('admin.contact.detail', $value->id) }}">
                                        <i class="far fa-edit"></i>Chi tiết
                                    </a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @include('admin.partials.pagination', ['itemPaginate' => $aryContact])

        </div>
    </div>
@endsection
