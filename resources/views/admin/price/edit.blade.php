@extends('admin.index')

@section('pageTitle', 'Thêm mới khoảng giá')

@section('admin.css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Khoảng giá</a></li>
    <li class="breadcrumb-item active">Thêm mới</li>
@endsection

@section('content')
    <div class="card col-6">
        <form enctype="multipart/form-data" method="POST" action="{{route('admin.price.add.post')}}">
            @csrf
            <input type="hidden" name="id" value="{{ $price->id }}">
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="productName">Tên khoảng giá</label>
                            <input type="text" name="name" class="form-control" id="price" value="{{ $price->name }}" placeholder="1.000.000đ đến 2.000.000đ...">
                        </div>
                        <div class="form-group">
                            <label for="productName">Giá thấp nhất</label>
                            <input type="text" name="min_price" class="form-control" id="minPrice" value="{{ number_format($price->min_price) }}" placeholder="Nhập giá thấp nhất...">
                        </div>
                        <div class="form-group">
                            <label for="productName">Giá cao nhất</label>
                            <input type="text" name="max_price" class="form-control" id="maxPrice" value="{{ number_format($price->max_price) }}" placeholder="Nhập giá cao nhất...">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Cập nhật</button>
                        <button type="button" class="btn btn-default float-right">
                            <a style="color: #000000" href="{{route('admin.price.list')}}">Hủy</a>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


