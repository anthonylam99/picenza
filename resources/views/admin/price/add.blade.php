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
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="productName">Tên khoảng giá</label>
                            <input type="text" name="name" class="form-control" id="productName" placeholder="1.000.000đ đến 2.000.000đ..." required>
                        </div>
                        <div class="form-group">
                            <label for="productName">Giá thấp nhất</label>
                            <input type="text" name="min_price" class="form-control" id="minPrice" placeholder="Nhập giá thấp nhất..." required>
                        </div>
                        <div class="form-group">
                            <label for="productName">Giá cao nhất</label>
                            <input type="text" name="max_price" class="form-control" id="maxPrice" placeholder="Nhập giá cao nhất..." required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                        <button type="button" class="btn btn-default float-right">
                            <a style="color: #000000" href="{{route('admin.price.list')}}">Hủy</a>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


