@extends('admin.index')

@section('pageTitle', 'Thêm mới hãng sản xuất')

@section('admin.css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Hãng sản xuất</a></li>
    <li class="breadcrumb-item active">Thêm mới</li>
@endsection

@section('content')
    <div class="card col-6">
        <form enctype="multipart/form-data" method="POST" action="{{route('admin.company.add.post')}}">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="productName">Tên hãng sản xuất</label>
                            <input type="text" name="company" class="form-control" id="productName" placeholder="Nhập tên hãng sản xuất...">
                        </div>
                        <div class="form-group">
                            <label for="productName">Dòng sản phẩm</label>
                            <input type="text" name="product_line" class="form-control" id="productName" placeholder="Nhập tên dòng sản phẩm...">
                        </div>
                        <div class="form-group">
                            <label for="productName">Loại sản phẩm</label>
                            <input type="text" name="product_type" class="form-control" id="productName" placeholder="Nhập tên loại sản phẩm...">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                        <button type="button" class="btn btn-default float-right">
                            <a style="color: #000000" href="{{route('admin.product.list')}}">Hủy</a>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


@section('admin.js')
    <script src="{{asset('js/admin.js')}}"></script>
@endsection
