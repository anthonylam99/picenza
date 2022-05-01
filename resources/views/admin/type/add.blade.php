@extends('admin.index')

@section('pageTitle', 'Thêm mới loại sản phẩm')

@section('admin.css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Loại sản phẩm</a></li>
    <li class="breadcrumb-item active">Thêm mới</li>
@endsection

@section('content')
    <div class="card col-6">
        <form enctype="multipart/form-data" method="POST" action="{{route('admin.type.add.post')}}">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="productName">Hãng sản xuất</label>
                            <select class="form-control" id="companyList" name="company_id" required>
                                <option>-- Vui lòng chọn ---</option>
                                @foreach($company as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="productName">Danh mục</label>
                            <select class="form-control" id="productLineList" name="product_line_id" required>
                                <option>-- Vui lòng chọn ---</option>
{{--                                @foreach($productLine as $value)--}}
{{--                                    <option value="{{$value->id}}">{{$value->name}}</option>--}}
{{--                                @endforeach--}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại sản phẩm</label>
                            <input type="text" name="productTypeName" class="form-control" id="lineName" placeholder="Nhập loại sản phẩm..." required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                        <button type="button" class="btn btn-default float-right">
                            <a style="color: #000000" href="{{route('admin.type.list')}}">Hủy</a>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


