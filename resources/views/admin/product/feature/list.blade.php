@extends('admin.index')

@section('pageTitle', '')

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Tính năng</a></li>
    <li class="breadcrumb-item active">Danh sách tính năng</li>
@endsection

@section('content')
    <div class="col-3">

    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title" style="font-size: 19px; font-weight: 700">Danh sách tính năng</h2>

                <div class="form-search float-right">
                    <form style="margin-bottom: 0" class="form-group" action="{{route('admin.type.add.post')}}">
{{--                        <input  class="form-control" type="text" name="s" value="" placeholder="Tìm kiếm sản phẩm....">--}}
                    </form>
                </div>
            </div>
            <div class="card-header p-0 align-middle">
                <h2 class="card-title" style="font-size: 19px; font-weight: 700"></h2>

                <div class="form-search float-right" style="padding-top: 10px">
                    <form style="margin-bottom: 0" class="form-group" action="{{route('admin.line.add')}}">
                        {{--                        <input  class="form-control" type="text" name="s" value="" placeholder="Tìm kiếm sản phẩm....">--}}
                        <button style="margin-bottom: 10px" type="button" class="btn btn-success">
                            <a style="color: #FFFFFF;" href="{{route('admin.product.feature.add.post')}}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Thêm mới
                            </a>
                        </button>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-bordered table-striped table-bordered bulk_action">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>TÍNH NĂNG</th>
                        <th>LOẠI SẢN PHẨM</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($feature as $value)
                            <tr>
                                <td>{{$value->id}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->productType->name}}</td>
                                <td>
                                    <button class="btn btn-info">
                                        <a style="color: #FFFFFF" href="{{ route('admin.type.edit', ['id' => $value->id]) }}">
                                            Chi tiết
                                        </a>
                                    </button>
                                    <button class="btn btn-danger">
                                        <a style="color: #FFFFFF" href="{{ route('admin.type.del', ['id' => $value->id]) }}">
                                            Xoá
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
